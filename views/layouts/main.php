<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Dropdown;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


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
					echo '<a href = "../user/security/login" style = "float: right; margin-left:15px;" class="btn btn-primary btn-small" ><i class="icon-white icon-user" ></i > Prijava</a>';
					} ?>
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

NavBar::begin([
	'options' => [
		'class' => 'nav',
		'role' => 'navigation',
		'style' => 'padding:0px;'
	],
]);

$menuItems = [
	['label' => Yii::t('app','Home'), 'url' => ['/site/index']],
	['label' => 'Home', 'url' => ['controller url here']],
	['label' => 'Home', 'url' => ['controller url here']]
];
	if (Yii::$app->user->isGuest) {
 	 $menuItems[] = ['label' => Yii::t('app','Register'), 'url' => ['/user/register']];
	 $menuItems[] = ['label' => Yii::t('app','Login'), 'url' => ['/user/login']];
	} else {
		$menuItems[] = '<li>'
	    	. Html::beginForm(['/user/logout'], 'post')
			. Html::submitButton(
				'Logout (' . Yii::$app->user->identity->username . ')',
					['class' => 'btn btn-link logout']
				)
			. Html::endForm()
			. '</li>';
			};
	$menuItems[] = "
	<li class='dropdown'>
		<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">Kategorije <span class=\"caret\"></span></a>
			<ul id=\"yw3\" class=\"dropdown-menu\">
				<li><a tabindex=\"-1\" href=\"/index.php/site/category/3\">Sport</a></li>
				<li><a tabindex=\"-1\" href=\"/index.php/site/category/4\">Zabava / Poznati / Muzika / Koncerti</a></li>
				<li><a tabindex=\"-1\" href=\"/index.php/site/category/5\">Putovanje / Priroda </a></li>
			</ul>
	</li>
	";
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

<div class="container" id="page">
   <div id="mainmenu">

        <?= $content ?>

        <div class="clear"></div>
        <div id="footer">





        </div>

    </div>
	</div>
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
