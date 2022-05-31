<?php
session_start();
include "connection.php";
$query_get_blogs = "SELECT * FROM BLOG ORDER BY BLOG_ID DESC";
$blog_conn = mysqli_query($conn, $query_get_blogs);
if ($blog_conn) {
    $blogs = mysqli_fetch_all($blog_conn);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    
    <link rel="stylesheet" href="css/general.css" />
    <link rel="stylesheet" href="css/styles.css" />

    <title>Forum | Website Name</title>
  </head>
  <body class="body-forum">
    <header class="wall-header">
      <div class="logo-nav">
        <a href="index.html" class="logo">WEBSITE <span>NAME</span></a>
      </div>

      <nav class="main-nav nav-other-page">
        <ul class="main-nav-list">
          <li>
            <a href="exam_sub_2.php" class="main-nav-link">Online Exam</a>
          </li>
          <li>
            <a href="#" class="main-nav-link">Forum</a>
          </li>
          <li>
            <a href="repository.php" class="main-nav-link">Repository</a>
          </li>
          <li>
            <a href="my_wall_update.php" class="main-nav-link nav-cta">My Wall</a>
          </li>
        </ul>
      </nav>
    </header>

    <main class="forum-body">
      <h2 class="posts-heading heading-secondary">Posts</h2>
      <div class="div--forum-container grid grid--2-cols">
        <div class="div--feed-container">
          <?php for ($i = 0; $i < count($blogs); $i++) {

              $blog_id = $blogs[$i][0];
              $poster_id = $blogs[$i][1];
              $content = $blogs[$i][2];
              $input_id = "comment_content" . $blog_id;
              $div_id = "current" . $blog_id;
              $query_get_name = "SELECT NAME FROM STUDENT_DETAILS WHERE SID = $poster_id";
              $query_get_image = "SELECT IMAGE FROM LOGIN_STUDENT WHERE SID = $poster_id";

              $get_name_conn = mysqli_query($conn, $query_get_name);
              $get_image_conn = mysqli_query($conn, $query_get_image);
              if ($get_name_conn) {
                  $poster_name = mysqli_fetch_array($get_name_conn);
                  $poster_image = mysqli_fetch_array($get_image_conn)[0];
                  echo "
              

              <div class='div-feed margin-bottom--lg'>
                <div class='div--profilepic-name margin-bottom--sm'>
                  <picture>
                    <source srcset='$poster_image' type='image/webp' />
                    <source srcset='$poster_image' type='image/png' />

                    <img src='$poster_image' alt='creater' class='forum-user-img' />
                  </picture>
                  <label class='sender-name'>$poster_name[0] </label>
                </div>
                
                <p class='feed-post margin-bottom--sm'> $content </p>

                <div class='div--reply-box margin-bottom--sm'>
                  <input
                    type='text'
                    name='comment-content'
                    id='$input_id'
                    placeholder='leave a reply...'
                    class='reply-box'
                  />
                  <ion-icon name='send-outline' class='icon-reply' onclick='post_comment($blog_id)' ></ion-icon>
                  <input type = 'text' id = '$blog_id' name = 'blog-id' value = '$blog_id' hidden>
                </div>
                
                <div class='post-comments'> 
                  <div class='comments'>
                    <div id = '$div_id'></div>
                  </div>
                </div> 
                ";
              }
              ?>
      
            <?php
            $query_get_comments = "SELECT * FROM BLOG_COMMENTS WHERE BLOG_ID = $blog_id";
            $get_comments_conn = mysqli_query($conn, $query_get_comments);
            $comments_id = "othercomments" . $blog_id;
            $label_id = "label" . $blog_id;

            $comments_array = mysqli_fetch_all($get_comments_conn);
            echo "<div class='comments' id = '$comments_id'>";
            if (count($comments_array) > 0) {
                echo "<label id = '$label_id' class = 'comments-heading margin-bottom--sm'> OTHER COMMENTS </label>";

                for ($j = 0; $j < count($comments_array); $j++) {
                    $comment = $comments_array[$j];
                    $commenter_id = $comment[2];
                    $query_get_commenter_name = "SELECT NAME FROM STUDENT_DETAILS WHERE SID = $commenter_id";
                    $get_commenter_conn = mysqli_query(
                        $conn,
                        $query_get_commenter_name
                    );
                    $get_commenter_name = mysqli_fetch_array(
                        $get_commenter_conn
                    );
                    $commenter_name = $get_commenter_name[0];
                    echo "<p class='commentor-name'> $commenter_name </p>";
                    echo "<p class='comment'> $comment[3]</p>";
                }
            } else {
                echo "<label id = '$label_id' class='comments-heading'>NO COMMENTS</label>";
            }
            echo "</div>";
            echo "</div>";

          } ?>   
          <div class="div--new-post">
            <label class="new-post-heading" for="">What's on your mind?</label>
            <form action="blog_post.php" method = "post">
              <textarea
                style="resize: none"
                class="new-post-text"
                name="content"
                id="content"
                cols="40"
                rows="10"
              ></textarea>
              <button class="btn btn-new-post-submit" type="submit">post</button>
            </form>
          </div>
        <!-- </div> -->
      
      <!-- </div> -->
      
    <!-- </div> -->
  </main>

    <script>
      const forumContainerEl = document.querySelector(".div--forum-container");

      const obs = new IntersectionObserver(
        function (entries) {
          const ent = entries[0];
          console.log(ent);
          if (!ent.isIntersecting) {
            document.body.classList.add("sticky");
          }

          if (ent.isIntersecting) {
            document.body.classList.remove("sticky");
          }
        },
        {
          root: null,
          threshold: 1,
          rootMargin: "-160px",
        }
      );
      obs.observe(forumContainerEl);

      function post_comment(blog_id)
      {
        // console.log(blog_id);
        var input_id = "comment_content" + blog_id;
        var div_id = 'current' + blog_id;
        var label_id = "label"+ blog_id;
        var comments_id = 'othercomments' + blog_id;
        // console.log(input_id);
        var comment = document.getElementById(input_id.toString()).value;
        var blog_id = document.getElementById(blog_id).value;
        // console.log(comment);
        // console.log(blog_id);
        const div_latest_comment = document.getElementById(div_id);
        const div_other_comments = document.getElementById(comments_id);
        const label_no_comments = document.getElementById(label_id);
        // console.log('other: ' + div_other_comments);
        // console.log(div_latest_comment);
        // console.log(div_other_comments.);


        var req = new XMLHttpRequest();
        req.open("get", "http://localhost:8888/E-EXAM%20IWT/post_comment.php?comment="+comment+"&blog_id="+blog_id, true);
        req.send();
        req.onreadystatechange = function(){
          if(req.readyState == 4)
          {
            var response = req.responseText;
            if(div_latest_comment.childNodes.length != 0 && div_other_comments.childNodes.length > 1)
            {
              label_no_comments.innerHTML = "OTHER COMMENTS";
              div_other_comments.innerHTML += div_latest_comment.innerHTML;
              div_latest_comment.innerHTML = null;
              div_latest_comment.innerHTML = response;
            }
            else if(div_other_comments.childNodes.length == 1)     // when the length of other comments wala div is 0
            {
              label_no_comments.innerHTML = " ";
              div_latest_comment.innerHTML = response;
              div_other_comments.innerHTML += "<p></p>";
            }
            else
            {
              div_latest_comment.innerHTML = response;
            }
            document.getElementById(input_id).value = "";
          }
          

      }
    }
    </script>
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
  </body>
  
</html>