<?php

namespace Post;

use Database\DBConnection;
use PDO;

require_once __DIR__ . "/../../vendor/autoload.php";

/**
 * Class Posts
 */
class Management
{

    public int $postId;
    public string $postTitle;
    public string $postBody;
    public string $createdAt;
    // public string $isPublished;
    private object $db;
    private int $userId;

    /**
     * Posts constructor.
     */
    public function __construct()
    {
        session_start();
        // $this->userId = intval($_SESSION["id"]);
        $this->db = new DBConnection();
    }

    /**
     * Create new post in database
     * @param string $title
     * @param string $body
     * @param string $isPublished
     */
    public function addPost(string $title, string $des, string $body, int $cateid): void
    {
        // Prepare the sql statement
        $this->db->query("INSERT INTO `blogs` (`blog_title`, `blog_des`,`blog_body`, `created_at`, `category_id`,`is_active`) 
        VALUES (:postTitle,:postDes, :postBody,:created ,:cat, true)");
        $this->db->bind(":postTitle",  $title, PDO::PARAM_STR);
        $this->db->bind(":postDes", $des, PDO::PARAM_STR);
        $this->db->bind(":postBody", $body, PDO::PARAM_STR);
        $this->db->bind(":created", date("l jS \of F Y h:i:s A"), PDO::PARAM_STR_CHAR);
        $this->db->bind(":cat", $cateid, PDO::PARAM_INT);

        // Execute the statement
        if ($this->db->execute()) {
            header("location: ../blogs.php?newPostStatus=1");
            die();
        } else {
            header("location: ../blogs.php?newPostStatus=2");
            die();
        }
    }

    /**
     * Delete the post in database
     * @param int $id
     */
    public function deletePost(int $id): void
    {
        $this->db->query("DELETE FROM `blogs` WHERE `blog_id`=:postId");
        $this->db->bind(":postId", $id, PDO::PARAM_INT);

        if ($this->db->execute()) {
            header("location: ../blogs.php?deletePostStatus=1");
            die();
        } else {
            header("location: ../blogs.php?deletePostStatus=2");
            die();
        }
    }

    /**
     * Get post
     * @param int $id
     */
    public function getPost(int $id): void
    {
        $this->db->query("SELECT `blog_title`, `blog_body`,`blog_des`, `created_at` FROM `blogs` WHERE `blog_id`=:id");
        $this->db->bind(":id", $id, PDO::PARAM_INT);
        $this->db->execute();
        $result = $this->db->fetch();
        $this->postId = $id;
        $this->postTitle = $result->blog_title;
        $this->postBody = $result->blog_body;
        $this->createdAt = $result->created_at;
    }

    /**
     * Update the post
     * @param string $title
     * @param string $body
     * @param string $isPublished
     * @param int $postId
     */
    public function updatePost(string $title, string $des, string $body,  int $postId): void
    {
        $this->db->query("UPDATE `blogs` SET `blog_title` = :title, `blog_des` = :descr,`blog_body` = :body WHERE `blog_id` = :id");
        $this->db->bind(":title", $title, PDO::PARAM_STR);
        $this->db->bind(":descr", $des, PDO::PARAM_STR);
        $this->db->bind(":body", $body, PDO::PARAM_STR);
        $this->db->bind(":id", $postId, PDO::PARAM_STR);

        if ($this->db->execute()) {
            header("location: ../blogs.php?updatePostStatus=1");
            die();
        } else {
            header("location: ../blogs.php?updatePostStatus=2");
            die();
        }
    }

    /**
     * Print messages received from request
     * @param string $type
     * @param int $errorCode
     */
    public function printMessages(string $type, int $errorCode): void
    {
        $errorMessage = "";
        if ($type == "newPost") {
            switch ($errorCode) {
                case 1:
                    $errorMessage = "Post Created Successfully";
                    break;
                case 2:
                    $errorMessage = "Something goes wrong";
                    break;
            }
        } elseif ($type == "deletePost") {
            switch ($errorCode) {
                case 1:
                    $errorMessage = "Post Deleted Successfully";
                    break;
                case 2:
                    $errorMessage = "Something goes wrong";
                    break;
            }
        } elseif ($type == "updatePost") {
            switch ($errorCode) {
                case 1:
                    $errorMessage = "Post Updated Successfully";
                    break;
                case 2:
                    $errorMessage = "Something goes wrong";
                    break;
            }
        }
?>
<div class="pt-3 pb-3 text-center text-white bg-<?php echo ($errorCode == 1) ? "success" : "danger" ?> w-100 h-auto">
    <b><?php echo $errorMessage; ?></b>
</div>
<?php
    }
}