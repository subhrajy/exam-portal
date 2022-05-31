<?php 
include "connection.php"; 
session_start();
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

    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/general.css" />

    <title>Repository</title>
  </head>
  <body>
    <header class="wall-header margin-bottom--md">
      <div class="logo-nav">
        <a href="index.html" class="logo">WEBSITE <span>NAME</span></a>
      </div>

      <nav class="main-nav nav-other-page">
        <ul class="main-nav-list">
          <li>
            <a href="exam_sub_2.php" class="main-nav-link">Online Exam</a>
          </li>
          <li>
            <a href="forum.php" class="main-nav-link">Forum</a>
          </li>
          <li>
            <a href="#" class="main-nav-link">Repository</a>
          </li>
          <li>
            <a href="my_wall_update.php" class="main-nav-link nav-cta"
              >My Wall</a
            >
          </li>
        </ul>
      </nav>
    </header>

    <main>
      <div class="exam-sub-heading margin-bottom--sm">
        <h1 class="heading-secondary heading-available-files">
          Uploaded Files
        </h1>
      </div>
      <div class="div--repository-container">
        <div class="div--uploaded-files">
          <table class="table-files">
            <thead>
              <th class="table--uploaded-date">Date</th>
              <th>By</th>
              <th>File Name</th>
            </thead>

            <tbody>
            <?php 
        $query_get_all = "SELECT * FROM UPLOADED_FILES WHERE FILEID >= 1";
        $files_conn = mysqli_query($conn, $query_get_all);
        if($files_conn)
        {
            $files = mysqli_fetch_all($files_conn);
            // print_r($files);
            if(count($files) > 0)
            {
              foreach($files as $file)
              { ?>
                  <tr>
                      <td><?php echo $file[3]; ?></td>
                      <td><?php echo $file[1]; ?></td>
                      <td><a download = "<?php echo explode('/',$file[2])[1]; ?>" href = "<?php echo $file[2]; ?>"> <?php echo explode('/', $file[2])[1];?></a></td>
                  </tr>
            <?php  }
           }
           else { ?>
                  <h1> No data present </h1>
           <?php }
            }

          ?>
            
           
            </tbody>
          </table>
        </div>

        <div class="div--upload-files">
          <div class="div--upload-files">
            <form action="upload_file.php" method = "post"  enctype = "multipart/form-data" form--upload-files">
              <label for="my-file" class="lbl--upload-files margin-bottom--sm" required
                >Upload files</label
              >
              <div>
                <input
                  required
                  type="file"
                  name="my-file"
                  id=""
                  class="btn btn--outline input-file margin-bottom--md"
                />

                <button type="submit" class="btn btn--full btn--file-submit">
                  Upload
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>
