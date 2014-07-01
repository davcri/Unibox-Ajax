<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Unibox</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="Smarty_dir/templates/css/style.css" rel="stylesheet" type="text/css" />
    <link href="Smarty_dir/templates/css/content.css" rel="stylesheet" type="text/css" />
    <link href="Smarty_dir/templates/css/contentDx.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="Library/jquery-ui/css/custom-theme/jquery-ui-1.10.4.custom.css">
    <script src="Library/jquery-ui/js/jquery-1.10.2.js"></script>
    <script src="Library/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
  </head>
  <body>
      <div class="header">
          <div class="headerContent">
              <div class="upperPart">
                      <a href="index.php"><img src="Smarty_dir/templates/img/logoBox2.jpg" id="logo_img"><h1></span>
                       <span>Unibox</span><span><small>ALL you need it's ME!!</small></a></h1>
              </div>
              <div class="bottomPart">
                    {*$loggedin=false*}
                    <div class="menu">

                        <div class="contentMenu" id="home"><a href="index.php">Home</a></div>

                        <div class="contentMenu" id="degreeCourse"><a href="index.php?controllerAction=navigation"> Degree Course</a></div>

                        <div class="contentMenu" id="upload"><a href="index.php?controllerAction=upload">Upload</a></div>

                        {if $loggedin}
                          <div class="contentMenu" id="profile"><a href="index.php">Profile</a></div>
                        {/if}
                    </div>
                    <div class="search">
                        <form id="form1" name="form1" method="post" action="#">
                            <input name="searchLabel" type="text" class="keywords" id="textfield" maxlength="50" value="Search..." />
                            <input name="submit" type="image" src="Smarty_dir/templates/img/search.gif" class="button" />

                        </form>
                    </div>
                    {if !$loggedin}
                      <div class="loginForm">
                          <form method="POST" action="index.php?controllerAction=login">
                                <input type="text" id="Username" name="username" value="Username"size="15"/>
                                <input type="password" id="Password" name="password" value="Password" size="15"/>
                                <input type="submit" id="loginButton" value="Sign In" />
                          </form>
                         	  <a href="index.php?controllerAction=registration" id="registered">Sign Up</a>
                      </div>
                    {else}
                    	 <a href="index.php?controllerAction=logout" id="logout">Logout</a>
                    {/if}
              </div>


          </div>


      </div>
      <div class="principalContent">
          <div class="leftPart">

              {$contentSx}

          </div>
          <div class="rightPart">
             {$contentDx}
          </div>


      </div>
      <div class="footer">




      </div>
  </body>
</html>
