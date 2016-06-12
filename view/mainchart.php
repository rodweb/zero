<?php
use B7KP\Utils\Snippets;
use B7KP\Utils\Charts;
use B7KP\Library\Route;
use B7KP\Library\Url;
use B7KP\Library\Lang;
?>
<!doctype html>
<html>
<?php
	$head = array("title" => "{$user->login} Charts");
	$this->render("ext/head.php", $head);
?>
	<body class="inner-min">
		<?php $this->render("ext/menu.php");?>
		<?php $this->render("ext/header.php", array("image" => $lfm_bg));?>
		<div id="fh5co-main">
			<section>
				<div class="container">
					<div class="row bottomspace-md">
						<div class="col-xs-12">
							<?php 
							$this->render("inc/profile-menu.php", array('user' => $user, 'usericon' => $lfm_image));
							?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 text-center bottomspace-md">
							<h3 class="topspace-sm"><?php echo Lang::get('last_1_x');?></h3>
							<div id="fh5co-tab-feature" class="fh5co-tab" style="display: block; width: 100%; margin: 0px;">
								<ul class="resp-tabs-list hor_1 hidden-xs">
									<li class="resp-tab-item hor_1" aria-controls="hor_1_tab_item-0" role="tab" style=""><i class="fh5co-tab-menu-icon ti-user"></i>&nbsp;<span class="hidden-sm"><?php echo Lang::get('art');?></span></li>
									<li class="resp-tab-item hor_1" aria-controls="hor_1_tab_item-1" role="tab" style=""><i class="fh5co-tab-menu-icon ti-music"></i>&nbsp;<span class="hidden-sm"><?php echo Lang::get('mus');?></span></li>
									<li class="resp-tab-item hor_1" aria-controls="hor_1_tab_item-2" role="tab" style=""><i class="fh5co-tab-menu-icon icon-vynil except"></i>&nbsp;<span class="hidden-sm"><?php echo Lang::get('alb');?></span></li>
								</ul>
								<div class="resp-tabs-container hor_1 divider-lr divider-bottom">
									<div class="resp-tab-content hor_1" aria-labelledby="hor_1_tab_item-0" style="">
										<div class="row">
											<div class="col-md-12 text-center">
												<h2 class="h3">Top <?php echo Lang::get('art_x');?></h2>
											</div>
											<div class="col-md-12 top-artists">
												<?php 
												if(is_array($weeks) && count($weeks) > 0)
												{
													$wkli = Url::getBaseUrl()."/user/".$user->login."/charts/artist/week/";
													foreach ($weeks as $value) {
														$weeklink = $wkli.$value["week"];
												?>
													<div class="row divider-tb bottomspace-sm">
														<div class="col-md-4 text-center">
															<h4 class="h3 no-margin"><?php echo $value["week"]?></h4>
															<small class="min-bold"><?php echo $value["from"];?></small>
															<small class="min-min"><?php echo Lang::get("to");?></small>
															<small class="min-bold"><?php echo $value["to"];?></small>
														</div>
														<div class="col-md-6 topspace-md text-center">
															<?php 
															if(is_array($value["artist"]) && count($value["artist"]) > 0)
															{
																$artist = $value["artist"][0];
															?>
															<h4 class="h3 no-margin"><?php echo $artist->artist;?></h4>
															<?php
															}
															else
															{
																echo Lang::get('no_data');
															}
															?>
														</div>
														<div class="col-md-2 topspace-md bottomspace-sm text-center">
															<a href="<?php echo $weeklink;?>" class="btn no-margin btn-custom btn-info btn-sm"><i class="ti-stats-up"></i></a>
														</div>
													</div>
												<?php
													}
												?>
												<div class="row text-center divider-tb bottomspace-sm">
													<a href="<?php echo Route::url('full_chart_list', array('login' => $user->login));?>" class="btn topspace-md btn-sm btn-outline"><?php echo Lang::get("ch_li");?></a>
												</div>
												<?php
												}
												else
												{
													echo Lang::get('no_data');
												}
												?>
											</div>
										</div>
									</div>
									<div class="resp-tab-content hor_1" aria-labelledby="hor_1_tab_item-1">
										<div class="row">
											<div class="col-md-12 text-center">
												<h2 class="h3">Top <?php echo Lang::get('mus_x');?></h2>
											</div>
											<div class="col-md-12 top-musics">
												<?php 
												if(is_array($weeks) && count($weeks) > 0)
												{
													$wkli = Url::getBaseUrl()."/user/".$user->login."/charts/music/week/";
													foreach ($weeks as $value) {
														$weeklink = $wkli.$value["week"];
												?>
													<div class="row divider-tb bottomspace-sm">
														<div class="col-md-4 text-center">
															<h4 class="h3 no-margin"><?php echo $value["week"]?></h4>
															<small class="min-bold"><?php echo $value["from"];?></small>
															<small class="min-min"><?php echo Lang::get("to");?></small>
															<small class="min-bold"><?php echo $value["to"];?></small>
														</div>
														<div class="col-md-6 text-center">
															<?php 

															if(is_array($value["music"]) && count($value["music"]) > 0)
															{
																$music = $value["music"][0];
															?>
															<h4 class="no-margin"><?php echo $music->music;?></h4>
															<span class="text-muted"><?php echo Lang::get('by');?></span>
															<?php echo $music->artist;?>
															<?php
															}
															else
															{
																echo Lang::get('no_data');
															}
															?>
														</div>
														<div class="col-md-2 topspace-md bottomspace-sm text-center">
															<a href="<?php echo $weeklink;?>" class="btn no-margin btn-custom btn-info btn-sm"><i class="ti-stats-up"></i></a>
														</div>
													</div>
												<?php
													}
												?>
												<div class="row text-center divider-tb bottomspace-sm">
													<a href="<?php echo Route::url('full_chart_list', array('login' => $user->login));?>" class="btn topspace-md btn-sm btn-outline"><?php echo Lang::get("ch_li");?></a>
												</div>
												<?php
												}
												else
												{
													echo Lang::get('no_data');
												}
												?>
											</div>
										</div>
									</div>
									<div class="resp-tab-content hor_1" aria-labelledby="hor_1_tab_item-2">
										<div class="row">
											<div class="col-md-12 text-center">
												<h2 class="h3">Top <?php echo Lang::get('alb_x');?></h2>
											</div>
											<div class="col-md-12 top-albums">
												<?php 
												if(is_array($weeks) && count($weeks) > 0)
												{
													$wkli = Url::getBaseUrl()."/user/".$user->login."/charts/album/week/";
													foreach ($weeks as $value) {
														$weeklink = $wkli.$value["week"];
												?>
													<div class="row divider-tb bottomspace-sm">
														<div class="col-md-4 text-center">
															<h4 class="h3 no-margin"><?php echo $value["week"]?></h4>
															<small class="min-bold"><?php echo $value["from"];?></small>
															<small class="min-min"><?php echo Lang::get("to");?></small>
															<small class="min-bold"><?php echo $value["to"];?></small>
														</div>
														<div class="col-md-6 text-center">
															<?php 

															if(is_array($value["album"]) && count($value["album"]) > 0)
															{


																$album = $value["album"][0];
															?>
															<h4 class="no-margin"><?php echo $album->album;?></h4>
															<span class="text-muted"><?php echo Lang::get('by');?></span>
															<?php echo $album->artist;?>
															<?php
															}
															else
															{
																echo Lang::get('no_data');
															}
															?>
														</div>
														<div class="col-md-2 topspace-md bottomspace-sm text-center">

															<a href="<?php echo $weeklink;?>" class="btn no-margin btn-custom btn-info btn-sm"><i class="ti-stats-up"></i></a>

														</div>
													</div>
												<?php
													}
												?>
												<div class="row text-center divider-tb bottomspace-sm">
													<a href="<?php echo Route::url('full_chart_list', array('login' => $user->login));?>" class="btn topspace-md btn-sm btn-outline"><?php echo Lang::get("ch_li");?></a>
												</div>
												<?php
												}
												else
												{
													echo Lang::get('no_data');
												}
												?>
											</div>
										</div>
									</div>
								</div>
								<br>
							</div>	
						</div>
						<div class="col-md-6">
							<h2 class="h3 text-center"><?php echo Lang::get('stats');?></h2>
							<table class="table table-bordered middle">
								<tr>
									<td>
										<?php echo Lang::get('big_one');?>
									</td>
									<td>
										<a href="<?php echo Route::url('bwp', array('login' => $user->login, 'type' => 'artist'));?>" class="no-margin btn btn-custom btn-info"><i class="ti-user"></i></a>
										<a href="<?php echo Route::url('bwp', array('login' => $user->login, 'type' => 'album'));?>" class="no-margin btn btn-custom btn-info"><i class="icon-vynil except"></i></a>
										<a href="<?php echo Route::url('bwp', array('login' => $user->login, 'type' => 'music'));?>" class="no-margin btn btn-custom btn-info"><i class="ti-music"></i></a>
									</td>
								</tr>
								<tr>
									<td>
										<?php echo Lang::get("big_num");?> #1 / Top 5 / etc...
									</td>
									<td>
										<a href="<?php echo Route::url('mwa', array('login' => $user->login, 'type' => 'artist', 'rank' => 1));?>" class="no-margin btn btn-custom btn-info"><i class="ti-user"></i></a>
										<a href="<?php echo Route::url('mwa', array('login' => $user->login, 'type' => 'album', 'rank' => 1));?>" class="no-margin btn btn-custom btn-info"><i class="icon-vynil except"></i></a>
										<a href="<?php echo Route::url('mwa', array('login' => $user->login, 'type' => 'music', 'rank' => 1));?>" class="no-margin btn btn-custom btn-info"><i class="ti-music"></i></a>

									</td>
								</tr>
								<tr>
									<td>
										Artistas com mais músicas/álbuns em #1
									</td>
									<td>
										<a href="<?php echo Route::url('mia', array('login' => $user->login, 'type' => 'album', 'rank' => 1));?>" class="no-margin btn btn-custom btn-info"><i class="ti-user"></i><i class="icon-vynil except"></i></a>
										<a href="<?php echo Route::url('mia', array('login' => $user->login, 'type' => 'music', 'rank' => 1));?>" class="no-margin btn btn-custom btn-info"><i class="ti-user"></i><i class="ti-music"></i></a>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</section>
			<?php $this->render("ext/footer.php");?>
		</div>
	</body>
</html>