<?php  include('server.php'); ?>
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM magictricks WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
            $chapterNumber = $n['chapterNumber'];
            $title = $n['title'];
            $b1h = $n['b1h'];
            $b1= $n['b1'];
            $imageOne = $n['imageOne'];
            $imageTwo = $n['imageTwo'];
            $imageThree = $n['imageThree'];
            $b2h = $n['b2h'];
            $b2 = $n['b2'];
            $b3h = $n['b3h'];
            $b3 = $n['b3'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .collapsible {
        background-color: #777;
        color: white;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        }

        .active, .collapsible:hover {
        background-color: #555;
        }

        .content {
        padding: 0 18px;
        display: none;
        overflow: hidden;
        background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="msg">
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>
    <button type="button" class="collapsible">Content Entry & Update Form (Click Here)</button>
        <div class="content">
        
        <form method="post" action="file-upload.php" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="col-md-3">Select File</label>
              <div class="col-md-8">
            <input type="file" name="uploadfile" class="form-control"/>
            </div>
            </div>
    
            <div class="form-group row">
              <label class="col-md-3"></label>
              <div class="col-md-8">
            <input type="submit" name="submit" class="btn btn-primary" onclick="return confirm('Check if you have selected file')">
          </div>
        </div>
      </form>
        
        <hr/>

        <form method="post" action="server.php" >

            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="input-group">
                <label>Chapter Number</label>
                <input type="text" name="chapterNumber" value="<?php echo $chapterNumber; ?>">
            </div>
            
            
            <div class="input-group">
                <label>Title</label>
                <input type="text" name="title" value="<?php echo $title; ?>">
            </div>
            

            <div class="input-group">
                <label>Header One</label>
                <input type="text" name="b1h" value="<?php echo $b1h; ?>">
            </div>
            

            <div class="input-group">
                <label>Header One Details</label>
                <input type="text" name="b1" value="<?php echo $b1; ?>">
            </div>
            <div class="input-group">
                <label>Image One Link</label>
                <input type="text" name="imageOne" value="<?php echo $imageOne; ?>">
            </div>
            <div class="input-group">
                <label>Image Two Link</label>
                <input type="text" name="imageTwo" value="<?php echo $imageTwo; ?>">
            </div>
            <div class="input-group">
                <label>Image Three Link</label>
                <input type="text" name="imageThree" value="<?php echo $imageThree; ?>">
            </div>
            <div class="input-group">
                <label>Header Two</label>
                <input type="text" name="b2h" value="<?php echo $b2h; ?>">
            </div>
            <div class="input-group">
                <label>Header Two Details</label>
                <input type="text" name="b2" value="<?php echo $b2; ?>">
            </div>
            <div class="input-group">
                <label>Header Three</label>
                <input type="text" name="b3h" value="<?php echo $b3h; ?>">
            </div>
            <div class="input-group">
                <label>Header Three Details</label>
                <input type="text" name="b3" value="<?php echo $b3; ?>">
            </div>
            <div class="input-group">
            <?php if ($update == true): ?>
                <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
            <?php else: ?>
                <button class="btn" type="submit" name="save" >Save</button>
            <?php endif ?>
            </div>

        </form>
        
    </div>
    <?php $results = mysqli_query($db, "SELECT * FROM magictricks"); ?>

    <table>
        <thead>
            <tr>
                <th>Count</th>
                <th>Chapter</th>
                <th>Title</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        
        <?php while ($row = mysqli_fetch_array($results)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['chapterNumber']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
                </td>
                <td>
                    <a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn" onclick="return confirm('Are you sure you want to delete this content')" >Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
</body>
</html>