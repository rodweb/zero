<?php
use B7KP\Utils\Snippets;
use B7KP\Utils\Charts;
use B7KP\Utils\Functions as F;
use B7KP\Library\Route;
use B7KP\Library\Url;
use B7KP\Library\Lang;
?>
<!doctype html>
<html>
<?php
	$head = array("title" => "{$user->login} Charts");
	$this->render("ext/head.php", $head);
	$curRoute = Route::getName(Url::getRequest());
?>
	<body class="inner-min">
		<?php $this->render("ext/menu.php");?>
		<?php $this->render("ext/header.php", array("image" => $lfm_bg));?>
		<div id="fh5co-main">
			<section>
				<div class="container">
					<div class="row bottomspace-xl text-center">
						<div class="col-xs-12">
							<?php 
							$this->render("inc/profile-menu.php", array('user' => $user, 'usericon' => $lfm_image));
							?>
						</div>
					</div>
					<div class="row bottomspace-md text-center">
						<div class="col-xs-12">
							<h3 class="h3">

							</h3>
						</div>
					</div>
					<div class="row text-center">
						<div class="col-xs-12">
							<div class="btn-group" role="group">
								<a href="<?php echo Route::url($curRoute, array('login' => $user->login, 'type' => 'artist'));?>" class="no-margin btn btn-custom btn-info"><i class="ti-user"></i></a>
								<a href="<?php echo Route::url($curRoute, array('login' => $user->login, 'type' => 'album'));?>" class="no-margin btn btn-custom btn-info"><i class="icon-vynil except"></i></a>
								<a href="<?php echo Route::url($curRoute, array('login' => $user->login, 'type' => 'music'));?>" class="no-margin btn btn-custom btn-info"><i class="ti-music"></i></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-10 col-md-offset-1 topspace-md">
						<?php
						if(is_array($list) && count($list) > 0)
						{
						?>
							<table class="table middle divider tablesorter">
								<thead>
								<tr>
									<th class="text-center">#</th>
									<?php if($type != "artist")  { ?>
									<th><?php echo Lang::get('title');?></th>
									<?php } ?>
									<th><?php echo Lang::get('art');?></th>
									<th class="text-center"><?php echo Lang::get('pt_x');?></th>
									<th class="text-center"><?php echo Lang::get('wk_x');?></th>
									<th class="text-center"><?php echo Lang::get('pk');?></th>
								</tr>								
								</thead>
								<tbody>
								<?php 
								$itemurl = Url::getBaseUrl()."/user/".$user->login."/music/";
								foreach ($list as $key => $value) 
								{
									$rest = $type != "artist" ? $type == "album" ? "/".F::fixLFM($value->$type) : "/_/".F::fixLFM($value->$type) : "" ;
								?>
								<tr>
									<td class="text-center"><?php echo $key+1;?></td>
									<td>
										<a href=<?php echo $itemurl.F::fixLFM($value->artist).$rest;?>>
										<?php echo $value->$type; ?>
										</a>
									</td>
									<?php if($type != "artist") { ?>
									<td>
										<a href=<?php echo $itemurl.F::fixLFM($value->artist);?>>
										<?php echo $value->artist; ?>
										</a>
									</td>
									<?php } ?>
									<td class="text-center"><?php echo $value->pts; ?></td>
									<td class="text-center"><?php echo $value->weeks; ?></td>
									<td class="text-center"><?php echo $value->peak; ?></td>
								</tr>
								<?php 
								}
								?>
								</tbody>
							</table>
						<?php
						}
						else
						{
							echo "<h3 class='text-center'>".Lang::get("no_data")."</h3>";
						}
						?>
						</div>
					</div>
				</div>
			</section>
			<?php $this->render("ext/footer.php");?>
		</div>
	</body>
</html>