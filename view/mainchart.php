<?php
use B7KP\Utils\Snippets;
use B7KP\Utils\Charts;
use B7KP\Library\Route;
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
		<?php $this->render("ext/header.php");?>
		<div id="fh5co-main">
			<section>
				<div class="container">
					<div class="row bottomspace-md text-center">
						<div class="col-xs-12">
							<h1 class="h3"><?php echo $user->login;?> Charts</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 divider text-center bottomspace-md">
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
													foreach ($weeks as $value) {
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
															$showlink = false;
															if(is_array($value["artist"]) && count($value["artist"]) > 0)
															{
																$showlink = true;
																$r = array("login" => $user->login, "type" => "artist", "week" => $value["week"]);
																$weeklink = Route::url('weekly_chart', $r);
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
														<?php 
														if($showlink)
														{
														?>
															<a href="<?php echo $weeklink;?>" class="btn no-margin btn-custom btn-info btn-sm"><i class="ti-stats-up"></i></a>
														<?php
														}
														?>
														</div>
													</div>
												<?php
													}
												?>
												<div class="row text-center divider-tb bottomspace-sm">
													<a href="#!" class="btn topspace-md btn-sm btn-outline disabled"><?php echo Lang::get("ch_li");?> *soon*</a>
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
													foreach ($weeks as $value) {
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
															$showlink = false;
															if(is_array($value["music"]) && count($value["music"]) > 0)
															{
																$showlink = true;
																$r = array("login" => $user->login, "type" => "music", "week" => $value["week"]);
																$weeklink = Route::url('weekly_chart', $r);
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
														<?php 
														if($showlink)
														{
														?>
															<a href="<?php echo $weeklink;?>" class="btn no-margin btn-custom btn-info btn-sm"><i class="ti-stats-up"></i></a>
														<?php
														}
														?>
														</div>
													</div>
												<?php
													}
												?>
												<div class="row text-center divider-tb bottomspace-sm">
													<a href="#!" class="btn topspace-md btn-sm btn-outline disabled"><?php echo Lang::get("ch_li");?> *soon*</a>
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
													foreach ($weeks as $value) {
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
															$showlink = false;
															if(is_array($value["album"]) && count($value["album"]) > 0)
															{
																$showlink = true;
																$r = array("login" => $user->login, "type" => "album", "week" => $value["week"]);
																$weeklink = Route::url('weekly_chart', $r);
																$album = $value["album"][0];
															?>
															<h4 class="no-margin"><?php echo $album->album;?></h4>
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
														<?php 
														if($showlink)
														{
														?>
															<a href="<?php echo $weeklink;?>" class="btn no-margin btn-custom btn-info btn-sm"><i class="ti-stats-up"></i></a>
														<?php
														}
														?>
														</div>
													</div>
												<?php
													}
												?>
												<div class="row text-center divider-tb bottomspace-sm">
													<a href="#!" class="btn topspace-md btn-sm btn-outline disabled"><?php echo Lang::get("ch_li");?> *soon*</a>
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
							*soon*
						</div>
					</div>
				</div>
			</section>
			<?php $this->render("ext/footer.php");?>
		</div>
	</body>
</html>