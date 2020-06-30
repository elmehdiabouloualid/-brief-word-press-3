<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">
    .labelstyle1, .labelstyle2, .labelstyle3{
      position: absolute;
      margin-top: 10px;
      margin-left: 10px;
    }
    .labelstyle2{
      margin-top: 70px;
    }
    .labelstyle3{
      margin-top: 205px;
    }
  </style>
</head>
<body>

</body>
</html>
<?php
if(isset($_POST['wphw_submit'])){
    CREE();
    insert();
}

function CREE(){
    
    $link = mysqli_connect("localhost", "root", "", "plugin");
    $sql = "CREATE TABLE mehdi (id int NOT NULL PRIMARY KEY AUTO_INCREMENT, username varchar(255) NOT NULL, descriptions varchar(255) NOT NULL, Options varchar(255) NOT NULL)";
    $result = mysqli_query($link, $sql);
    return $result;

}

function insert(){

    $link = mysqli_connect("localhost", "root", "", "plugin");
    $username= $_POST['username'];  
    $descriptions = $_POST['descriptions'];
    $Options= $_POST['Options'];

    if(empty($_POST['username']) || empty($_POST['descriptions']) || empty($_POST['Options'] ))
    {
         
    }
    else
    {
         $query="insert INTO mehdi (username,descriptions,Options)". "VALUES ('$username', '$descriptions', '$Options')";
         $result=mysqli_query($link,$query);
    }
}

?>

<div class="wrap">
  <div id="icon-options-general" class="icon32"> <br>
  </div>
  <h2>Plugin Settings</h2>
  <?php if(isset($_POST['wphw_submit'])):?>
  <div id="message" class="updated below-h2">
    <p>Contenu ajouté avec succès</p>
  </div>
  <?php endif;?>
  <div class="metabox-holder">
    <div class="postbox">
    
      <form method="post" action="">
      <table class="form-table" style="margin-left: -90px;">
          <tr>
            <th scope="row"></th><div class="labelstyle1"><label style="font-size: 20px;">utilisateur : &nbsp</label></div>
            <td> <input type="text" name="username" value="" style="width:400px;" placeholder="" /></td>
          </tr>

          <tr>
            <th scope="row"></th><div class="labelstyle2"><label class="labelstyle" style="font-size: 20px;">Description : </label></div>
            <td><textarea name="descriptions" value="" style="width:400px; height: 100px;" placeholder=""></textarea></td>
          </tr>

          <tr>
            <th scope="row"></th><div class="labelstyle3"><label style="font-size: 20px;">Options : &nbsp &nbsp &nbsp </label></div>
            <td><select name="Options" style="width:400px;">
                <option value="">--Select--</option>
                <option name="OptionA" value="OptionA">Option A</option>
                <option name="OptionB" value="OptionB">Option B</option>
                <option name="OptionB" value="OptionB">Option c</option>
           </td>
          </tr>
          
          <tr>
            <th scope="row">&nbsp;</th>
            <td style="padding-top:10px;padding-bottom:10px;">
<input type="submit" name="wphw_submit" value="enregistrer" class="button-primary" style="width:10%; margin-left: -120px;" />
</td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
