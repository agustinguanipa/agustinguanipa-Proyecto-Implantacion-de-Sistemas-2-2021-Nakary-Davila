<?php 
include('top.php');
$msg="";
$category="";
$order_number="";
$id="";

if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from category where id='$id'"));
	$category=$row['category'];
	$order_number=$row['order_number'];
}

if(isset($_POST['submit'])){
	$category=get_safe_value($_POST['category']);
	$order_number=get_safe_value($_POST['order_number']);
	$added_on=date('Y-m-d h:i:s');
	
	if($id==''){
		$sql="select * from category where category='$category'";
	}else{
		$sql="select * from category where category='$category' and id!='$id'";
	}	
	if(mysqli_num_rows(mysqli_query($con,$sql))>0){
		$msg="Category already added";
	}else{
		if($id==''){
			mysqli_query($con,"insert into category(category,order_number,status,added_on) values('$category','$order_number',1,'$added_on')");
		}else{
			mysqli_query($con,"update category set category='$category', order_number='$order_number' where id='$id'");
		}
		
		redirect('category.php');
	}
}
?>
<div class="row">
			<h1 class="grid_title ml10 ml15">Añadir Categoría</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Categoría</label>
                      <input type="text" class="form-control" placeholder="Categoria" name="category" required value="<?php echo $category?>">
					  <div class="error mt8"><?php echo $msg?></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3" required>Nº de Orden (orden en la lista)</label>
                      <input type="textbox" class="form-control" placeholder="Numero de Orden" name="order_number"  value="<?php echo $order_number?>">
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Añadir</button>
                  </form>
                </div>
              </div>
            </div>
            
		 </div>
        
<?php include('footer.php');?>