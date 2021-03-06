<?php
use B7KP\Utils\Snippets;
use B7KP\Utils\Charts;
use B7KP\Utils\Certified;
use B7KP\Library\Route;
use B7KP\Library\Url;
use B7KP\Library\Lang;
use B7KP\Utils\Constants as C;
use B7KP\Utils\Functions as F;
use B7KP\Utils\Snippets as S;
?>
<!doctype html>
<html>
<?php
	$head = array("title" => "{$user->login} - ".Lang::get("alb_x"));
	$this->render("ext/head.php", $head);
?>

	<body class="inner-min">
		<?php $this->render("ext/menu.php");?>
		<?php $this->render("ext/header.php", array("image" => $lfm_bg));?>
		<div id="fh5co-main">
			<section>
				<div class="container">
					<div class="row text-center">
						<div class="col-xs-12">
							<?php 
							$this->render("inc/profile-menu.php", array('user' => $user, 'usericon' => $lfm_image));
							?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 topspace-md">
						<?php
						if(is_array($list) && count($list) > 0)
						{
						?>
							<table class="chart-table table-fluid topspace-md">

								<tr>
									<th class="text-center">#</th>
									<th class="text-center"><?php echo Lang::get('art');?></th>
									<th>&nbsp;</th>
									<th><?php echo Lang::get('alb');?></th>
									<th class="text-center"><?php echo Lang::get('play_x');?></th>
									<th class="text-center"><?php echo Lang::get('wk_x');?></th>
									<th class="text-center"><?php echo Lang::get('pk');?></th>
									<?php 
									if($settings->show_points){
									?>
									<th class="text-center"><?php echo Lang::get('pt_x');?></th>
									<th class="text-center"><?php echo empty($settings->custom_unity) ? Lang::get('both_x') : $settings->custom_unity;?></th>
									<?php
									}
									?>
									<?php 
									if($settings->show_chart_cert){
									?>
									<th class="text-center"><?php echo Lang::get('cert_s');?></th>
									<?php
									}
									?>
								</tr>								


								<?php 
								$liburl = Url::getBaseUrl()."/user/".$user->login."/music/";
								foreach ($list as $value) 
								{
									$totalweeks = $value["stats"]["stats"]["alltime"]["weeks"]["total"];
									$peak = $value["stats"]["stats"]["alltime"]["overall"]["peak"];
									$pts = intval($value["stats"]["stats"]["alltime"]["overall"]["chartpoints"]);
									if(empty($totalweeks) && empty($peak))
									{
										$totalweeks = "N/C";
										$peak = "N/C";
									}
								?>
								<tr>
									<td class="text-center rk-col"><?php echo $value["rank"];?></td>
									<td class="text-center">
										<img class="" src="<?php echo $value["img"]; ?>" height="60">
									</td>
									<td>
										<a href=<?php echo $liburl.F::fixLFM($value["artist"]);?>>
											<?php echo $value["artist"]; ?>
										</a>
									</td>
									<td>
										<a href=<?php echo $liburl.F::fixLFM($value["artist"])."/".F::fixLFM($value["music"]);?>>
											<?php echo $value["music"]; ?>
										</a>
									</td>
									<td class="text-center rk-col"><?php echo $value["playcount"]; ?></td>
									<td class="text-center rk-col"><?php echo $totalweeks;?></td>
									<td class="text-center rk-col"><?php echo $peak;?></td>
									<?php 
									if($settings->show_points){
									?>
									<td class="text-center rk-col"><?php echo $pts;?></td>
									<td class="text-center rk-col"><?php echo ($pts * $settings->weight_alb_pts) + ($value["playcount"] * $settings->weight_alb_pls);?></td>
									<?php
									}
									?>
									<?php 
									if($settings->show_chart_cert){
										$c = new Certified($user, $this->factory);
										switch ($settings->cert_type){
                                            case "2":
                                                $cert = $c->getCertification("album", ($pts * $settings->weight_alb_pts) + ($value["playcount"] * $settings->weight_alb_pls), "text+icon");
                                                break;
                                            case "1":
                                                $cert = $c->getCertification("album", $pts, "text+icon");
                                                break;
                                            default:
                                                $cert = $c->getCertification("album", $value["playcount"], "text+icon");
                                                break;
                                        }
									?>
									<td class="text-center rk-col"><?php echo $cert;?></td>
									<?php
									}
									?>
								</tr>
								<?php 
								}
								$cond = array("login" => $user->login);
								$totalpages = $info->totalPages;
								?>

							</table>
							<div class="row topspace-md">
								<div class="col-xs-12">
									<?php 
									if($page > 2)
									{
									?>
										<a class="btn btn-custom btn-sm divider" href="<?php echo Route::url('lib_alb_list', $cond)."?page=1";?>"><i class="ti-angle-double-left"></i></a>
									<?php
									}
									?>

									<?php 
									if($page > 1)
									{
									?>
										<a class="btn btn-custom btn-sm divider" href="<?php echo Route::url('lib_alb_list', $cond)."?page=".($page-1);?>"><i class="ti-angle-left"></i></a>
									<?php
									}
									?>
									<a class="btn btn-custom btn-sm divider disabled" href="<?php echo Route::url('lib_alb_list', $cond)."?page=".$page;?>"><?php echo $page;?></a>

									<?php 
									if($totalpages > $page)
									{
									?>
										<a class="btn btn-custom btn-sm divider" href="<?php echo Route::url('lib_alb_list', $cond)."?page=".($page+1);?>"><i class="ti-angle-right"></i></a>
									<?php
									}
									?>

									<?php 
									if($totalpages > 1 && ($totalpages - $page) >= 2)
									{
									?>
										<a class="btn btn-custom btn-sm divider" href="<?php echo Route::url('lib_alb_list', $cond)."?page=".$totalpages;?>"><i class="ti-angle-double-right"></i></a>
									<?php
									}
									?>
								</div>
							</div>
							<?php 

							?>
						<?php
						}
						else
						{

							echo "<div class='bottomspace-mega'>".Lang::get("no_data")."</div>";
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