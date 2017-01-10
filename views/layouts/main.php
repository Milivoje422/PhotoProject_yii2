<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Dropdown;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Category;
use app\models\Profile;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <?= Html::csrfMetaTags() ?>
        <title><?= Yii::$app->id; ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div id="wrap">
<div class="navbar-custom">
	<div class="language-info">
		<?php
		switch (\Yii::$app->getRequest()->getCookies()->getValue('lang')) {
			case "sr":
				echo '<img src="'.Yii::$app->request->BaseUrl.'/bootstrap/img/langsr.png"/>';
				break;
			case "ru":
				echo '<img src="'.Yii::$app->request->BaseUrl.'/bootstrap/img/RussiaFlag.png"/>';
				break;
			case "fr":
				echo '<img src="'.Yii::$app->request->BaseUrl.'/bootstrap/img/FranceFlag.png"/>';
				break;
			case "en":
				echo '<img src="'.Yii::$app->request->BaseUrl.'/bootstrap/img/langen.png"/>';
				break;
		}
		?>
		<div class="dropdown_selection_languages">
			<ul>
				<?php
					foreach(Yii::$app->params['languages'] as $key => $language) {
						echo '<li id="'.$key.'">'. $language['language'] .'</li>';
					}
				?>
			</ul>
		</div>
	</div>
	<div class="container" style="float:none; margin:auto;">
		<div class="row">
			<div class="nav-up-staff">
				<div class="logo-main" style="width:65%; float:left;">
					<img src="<?= Yii::$app->request->BaseUrl; ?>/bootstrap/img/logo-public.png" style="width:80%;" class="logo-icon"/>
					<img src="<?= Yii::$app->request->BaseUrl; ?>/bootstrap/img/logo-public-small.png" style="width:100%;" class="logo-icon-small"/>
				</div>
				<div class="options-main" style="width:35%; float:left; margin-top:15px;">
					<?php if (Yii::$app->user->isGuest) {
						echo '<a href = "../user/security/login" style = "float: right; margin-left:15px;" class="btn btn-primary btn-small" ><i class="icon-white icon-user" ></i>'.Yii::t("app","Login").'</a>';
					}else{
						echo '
						<div class="btn-group" style = "float: right; margin-left:15px;">
							<button class="btn btn-primary btn-ms dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								'. Yii::$app->user->identity->username .' <span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li>test</li>
								<li>test</li>
								<li>test</li>
								<li>'.

										Html::beginForm(['/user/logout'], 'post'),
							            Html::submitButton('Logout',[]),
										Html::endForm()
									.'
								</li>
							</ul>
						</div>';
					}	?>


					<div class="language-main-class" style="width:65% !important; float:right;">
						<select name="webmenu" id="webmenu" class="form-control">
							<?php
							switch (\Yii::$app->getRequest()->getCookies()->getValue('lang')) {
								case "sr":
									echo '<option value="sr" id="sr" title="'.Yii::$app->request->BaseUrl.'/bootstrap/img/langsr.png">Serbian</option>';
									break;
								case "ru":
									echo '<option value="ru" id="ru" title="'.Yii::$app->request->BaseUrl.'/bootstrap/img/RussiaFlag.png">Russian</option>';
									break;
								case "fr":
									echo '<option value="fr" id="fr" title="'.Yii::$app->request->BaseUrl.'/bootstrap/img/FranceFlag.png">French</option>';
									break;
								case "en":
									echo '<option value="en" id="en" title="'.Yii::$app->request->BaseUrl.'/bootstrap/img/langen.png">English</option>';
									break;
							}
							        foreach(Yii::$app->params['languages'] as $key => $language) {
								        echo '<option value="'.$key.'" id="'.$key.'" title="'.Yii::$app->request->BaseUrl.$language["flag"].'" >'. $language['language'] .'</option>';
							        }
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="navbar nav-bar-menu" style="padding:0px; margin-bottom:0px !important;">
			<?php

		$cat = Category::find()->all();
		$photo = Profile::find()->where('account_type = 2')->all();


NavBar::begin([
	'options' => [
		'class' => 'nav',
		'role' => 'navigation',
		'style' => 'padding:0px;'
	],
]);

$menuItems = [
	['label' => Yii::t('app','Home'), 'url' => ['/site/index']],
	['label' => Yii::t('app','Gallery'), 'url' => ['/site/gallery']],
	['label' => Yii::t('app','News'), 'url' => ['/site/news']],
	['label' => Yii::t('app','Reports'), 'url' => ['/site/reports']]
];
	$menuItems[] = "
	<li class='dropdown'>
		<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">".Yii::t('app','Categories')."</a>
			<ul id=\"yw3\" class=\"dropdown-menu\">";

			foreach ($cat as $key => $cat_){
			$menuItems[] =  "<li><a tabindex=".$key." href='/site/category/".$cat_['category_id']."'>".$cat_['category_name']."</a></li>";
				}


	$menuItems[] ="</ul>
	</li>";

	$menuItems[] = "
	<li class='dropdown'>
		<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">".Yii::t('app','Photographers')."</a>
			<ul id=\"yw3\" class=\"dropdown-menu\">";

			foreach ($photo as $key => $photos){
				$menuItems[] =  "<li><a tabindex=".$key." href='/site/photos/".$photos['user_id']."'>".$photos['name']." ".$photos['lastname']."</a></li>";
			}
			$menuItems[] ="</ul>
	</li>";

	$menuItems[] = "
	<li class='dropdown'>
		<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">".Yii::t('app','Service')."</a>
			<ul id=\"yw3\" class=\"dropdown-menu\">
				<li class='dropdown'>
					<a tabindex='1' href='/site/photography'>".Yii::t('app','Photography')."</a>
					<a tabindex='2' href='/site/cooperation'>".Yii::t('app','Cooperation')."</a>
				</li>
			</ul>
	</li>";

	$menuItems[] = "
	<li class='dropdown'>
		<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">".Yii::t('app','Agency')."</a>
			<ul id=\"yw3\" class=\"dropdown-menu\">";

			foreach (Yii::$app->params['agency'] as $key => $item){
				$menuItems[] =  "<li><a tabindex=".$key." href='".$item['url']."'>".$item['menu']."</a></li>";
			}
	$menuItems[] ="
		</ul>
	</li>";

	if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin) {
		$menuItems[] = ['label' => Yii::t('app','Admins permissions'), 'url' => ['/user/admin/index']];
	}


 echo Nav::widget([
	 'options' => ['class' => 'navbar-nav navbar-left'],
	 'items' => $menuItems,
 ]);
NavBar::end();


			?>
				</div>
			</div>
		</div>
	</div>
</div>

<!--<div class="container" id="page">-->
<!--   <div id="mainmenu">-->

        <?php  // $content ?>

<!--        <div class="clear"></div>-->




        <div id="footer">





        </div>

<!--    </div>-->
<!--	</div>-->
</div>
    <?php $this->endBody() ?>
    <script type="text/javascript">

	    function doAjax(data, url){
		    $.ajax({
			    method: "POST",
			    url: url,
			    data: {lang: data},
			    success:function(data){
				    location.reload();
			    }
		    });
	    }
	    $(document).ready(function(){

		    $(".options-main select").msDropDown();

		    $('.language-info img').click(function() {
			    $('.dropdown_selection_languages').fadeToggle(500);
		    });

		    $('.dropdown_selection_languages ul li').click(function(){
			    var lang_small = $(this).attr('id');
			    var url = "<?= Yii::$app->request->BaseUrl; ?>/site/language";
			    doAjax(lang_small, url);
		    });


		    $('#webmenu').on('change', function(){
			    var lang = $("#webmenu option:selected").val();
			    var url = "<?= Yii::$app->request->BaseUrl; ?>/site/language";
			    doAjax(lang, url);

		    });
	    });

    </script>
</body>
</html>
<?php $this->endPage() ?>
