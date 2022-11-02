<?PHP include 'inc/header.php';?>
<?PHP include 'inc/slider.php';?>	

<div class="contentsection contemplete clear">
<div class="maincontent clear">
<!------pagination---->
<?php
	$per_page=3;
	if(isset($_GET["page"])){
		$page=$_GET["page"];
	}else{
		$page=1;
	}
	$start_from=($page-1)*$per_page;
?>
<!------pagination---->
<?php
$query="select * from tbl_post order by id desc limit $start_from,$per_page";
$post=$db->select($query);
if($post){
	while($result=$post->fetch_assoc()){
?>
		
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h2>
				<h4><?php echo $fm->formatDate($result['date']);?>, By <a href="#"><?php echo $result['author'];?></a></h4>
				 <a href="#"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
				<?php echo $fm->textShorten($result['body'],200);?>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id'];?>">Read more</a>
				</div>
			</div>
<?PHP } ?><!------end of whole loop---->
<!------pagination---->
<?php
$query="select * from tbl_post";
$result=$db->select($query);
$total_rows=mysqli_num_rows($result);
$tolal_pages=ceil($total_rows/$per_page);

echo "<span class='pagination'><a href='index.php?page=1'>".'First page'."</a>";
for($i=1;$i<=$tolal_pages;$i++){
echo "<a href='index.php?page=".$i."'>".$i."</a>";	
}
echo "<a href='index.php?page=$tolal_pages'>".'Last page'."</a>"?>
<!------pagination---->

<?PHP }else {header("location:404.php");}?>			
</div>

<?PHP include "inc/sidebar.php";?>
<?PHP include 'inc/footer.php';?>