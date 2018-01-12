<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/myservice/common/session.php';
    if(!isset($_SESSION['myMemberSes'])){
        header("Location:./index.php");
        exit;
    }
    include_once $_SERVER['DOCUMENT_ROOT'].'/myservice/database/contents.php';
    $myContents = $contents->contentsLoad('me');

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width" />
<meta charset="utf-8" />
<title>My Web Service</title>
<link rel="stylesheet" href="http://localhost/myservice/css/cssReset.css"/>
<link rel="stylesheet" href="http://localhost/myservice/css/header.css"/>
<link rel="stylesheet" href="http://localhost/myservice/css/footer.css"/>
<link rel="stylesheet" href="http://localhost/myservice/css/me.css" />

<script type="text/javascript" src="http://localhost/myservice/js/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="http://localhost/myservice/js/me.js"></script>

<style>
#myWallPhoto{background:url('<?=$_SESSION['myMemberSes']['coverPhoto']?>');background-size:cover; background-repeat:no-repeat;background-position:50% 50%;border-bottom:1px solid #ccc}
</style>
</head>
<body>

    <?php
      include_once $_SERVER['DOCUMENT_ROOT'].'/myservice/include/header.php';
    ?>

    <div id="container">
        <div id="center">
            <div id="myWallPhoto"></div>
            <div id="myProfilePhoto">
                <img src="<?=$_SESSION['myMemberSes']['profilePhoto']?>" />
            </div>
            <p id="name"><?=$_SESSION['myMemberSes']['userName']?></p>

                <div class="myButtonBox">
                <form name="photo" method="post" action="http://localhost/myservice/database/myMember.php" enctype="multipart/form-data">
                    <div class="photoBox">
                        <input type="file" name="myProfilePhoto" class="photoSelectorBtn"/>
                    </div>

                    <input type="hidden" name="mode" value="photo" />

                    <div class="photoBox">
                        <input type="submit" id="myProfilePhotoUploadBtn" value="프로필 사진 변경" />
                    </div>
                </form>
            </div>

            <div class="myButtonBox">
                <form name="photo" method="post" action="http://localhost/myservice/database/myMember.php" enctype="multipart/form-data">
                    <div class="photoBox">
                        <input type="file" name="myCoverPhoto" class="photoSelectorBtn" />
                    </div>
                    <input type="hidden" name="mode" value="photo" />
                    <div class="photoBox">
                        <input type="submit" id="myCoverPhotoUploadBtn" value="커버 사진 변경" />
                    </div>
                </form>
            </div>

            <div id="myContent">
                <!-- timeline -->
                <div id="writing">
                    <div class="me">
                        <img src="./images/me/happycat.png" />
                        <p>물빛종이</p>
                    </div>
                    <textarea maxlength="500" id="meContent"></textarea>
                    <div id="inputBox">
                        <input type="button" id="mePostBtn" value="게시" />
                    </div>
                </div>







        	<?php
        foreach ($myContents as $mc){
            ?>

                <div class="reading">
                    <div class="writerArea">
                        <img src="<?=$mc['profilePhoto']?>" />
                        <div class="writingInfo">
                            <p><?=$mc['userName']?></p>
                            <div class="writingDate">
                            <?=date('Y년 m월 d일 H시 i분', $mc['regTime'])?>
                            </div>
                        </div>
                    </div>

                    <span class="content"><?=nl2br(htmlspecialchars($mc['content']))?> </span>

                    <div class="myCommentArea myCommentArea<?=$mc['contentsID']?>">
                      <?php
                          foreach($mc['comment'] as $comment){ ?>
                          <div class="commentBox">
                              <img src="<?=$comment['profilePhoto']?>" />
                              <p class="commentRegTime"><?=date('Y년 m월 d일 H시 i분',$comment['regTime'])?></p>
                              <p class="commentPoster"><?=$comment['userName']?></p>
                              <p class="writtenComment"><?=nl2br(htmlspecialchars($comment['comment']))?></p>

                          </div>
                      <?php
                          }
                      ?>
                      </div>




                    <div class="inputBox">
                        <img src="<?=$_SESSION['myMemberSes']['profilePhoto']?>" />
                        <input type="text" class="inputComment comments<?=$mc['contentsID']?>" placeholder="코멘트 입력"/>
                        <div class="regCommentBox">
                            <input type="button" class="regCommentBtn" id="comments<?=$mc['contentsID']?>" value="게시" />
                        </div>
                    </div>
                </div>
    <?php
    }
    ?>


                <!-- end of timeline -->
            </div>
            <input type="hidden" name="page" id="page" value="<?=((count($myContents) >= 20) ? 1: 0);?>" />
        </div>
        <div id="noContents">
            더 이상 콘텐츠가 없습니다.
        </div>
    </div>

     <?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/myservice/include/footer.php';
    ?>
</body>
</html>
