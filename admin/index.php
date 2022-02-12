<?php include('top.php');?>

<div class="row">
	<div class="col-md-6 col-lg-6 grid-margin stretch-card">
	  <div class="card">
		<div class="card-body">
		  <h1 class="font-weight-light mb-4">
			<?php 
			$row=mysqli_fetch_assoc(mysqli_query($con,"SELECT count(order_detail.dish_details_id) as t, dish.dish from order_detail,dish_details,dish WHERE order_detail.dish_details_id=dish_details.id and dish_details.dish_id=dish.id group by order_detail.dish_details_id order by count(order_detail.dish_details_id) desc limit 1"));
			echo $row['dish'];
			echo "<br/>";
			echo '<span style="font-size:15px;">('.$row['t'].' Times)</span>';
			?>
		  </h1>
		  <div class="d-flex flex-wrap align-items-center">
			<div>
			  <h4 class="font-weight-normal">Dulce Mas Comprado</h4>
			  
			</div>
			<i class="mdi mdi-food icon-lg text-primary ml-auto"></i>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="col-md-6 col-lg-6 grid-margin stretch-card">
	  <div class="card">
		<div class="card-body">
		  <h1 class="font-weight-light mb-4">
			<?php 
			$row=mysqli_fetch_assoc(mysqli_query($con,"select count(order_master.user_id) as t,user.name from order_master,user WHERE order_master.user_id=user.id GROUP BY order_master.user_id order by count(order_master.user_id) desc limit 1"));
			echo $row['name'];
			echo "<br/>";
			echo '<span style="font-size:15px;">('.$row['t'].' Times)</span>';
			?>
		  </h1>
		  <div class="d-flex flex-wrap align-items-center">
			<div>
			  <h4 class="font-weight-normal">Usuario Mas Activo</h4>
			  
			</div>
			<i class="mdi mdi-account icon-lg text-primary ml-auto"></i>
		  </div>
		</div>
	  </div>
	</div>
  </div>
  <?php
  $sql="select order_master.*,order_status.order_status as order_status_str from order_master,order_status where order_master.order_status=order_status.id order by order_master.id desc limit 5";
$res=mysqli_query($con,$sql);
  ?>
  <div class="row">
	<div class="col-12">
	  <div class="card">
		<div class="card-body">
		  <h4 class="card-title">Últimas Ordenes</h4>
		  <div class="table-responsive">
			<table class="table table-hover">
			  <thead>
				<tr>
				   <th width="5%"># Orden</th>
					<th width="20%">Nombre/Correo/Telefono</th>
					<th width="20%">Direccion/Codigo</th>
					<th width="5%">Precio</th>
					<th width="10%">Tipo de Pago</th>
					<th width="10%">Status Pago</th>
					<th width="10%">Status ORden</th>
					<th width="15%">Fecha</th>
				</tr>
			  </thead>
			  <tbody>
                        <?php if(mysqli_num_rows($res)>0){
						$i=1;
						while($row=mysqli_fetch_assoc($res)){
						?>
						<tr>
                            <td>
								<div class="div_order_id">
									<a href="order_detail.php?id=<?php echo $row['id']?>"><?php echo $row['id']?></a>
								</div>
							</td>
                            <td>
								<p><?php echo $row['name']?></p>
								<p><?php echo $row['email']?></p>
								<p><?php echo $row['mobile']?></p>
							<td>
								<p><?php echo $row['address']?></p>
								<p><?php echo $row['zipcode']?></p>
							</td>
							<td style="font-size:14px;"><?php echo $row['total_price']?><br/>
								<?php
								if($row['coupon_code']!=''){
								?>
								<?php echo $row['coupon_code']?><br/>
								<?php echo $row['final_price']?>
								<?php } ?>
							
							</td>
							<td><?php echo $row['payment_type']?></td>
							<td>
								<div class="payment_status payment_status_<?php echo $row['payment_status']?>"><?php echo ucfirst($row['payment_status'])?></div>
							</td>
							<td><?php echo $row['order_status_str']?></td>
							<td>
							<?php 
							$dateStr=strtotime($row['added_on']);
							echo date('d-m-Y h:s',$dateStr);
							?>
							</td>
							
                        </tr>
                        <?php 
						$i++;
						} } else { ?>
						<tr>
							<td colspan="6">No data found</td>
						</tr>
						<?php } ?>
                      </tbody>
			</table>
		  </div>
		</div>
	  </div>
	</div>
  </div>
  

<?php include('footer.php');?>