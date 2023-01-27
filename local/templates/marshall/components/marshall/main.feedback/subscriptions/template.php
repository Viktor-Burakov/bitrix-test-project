<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>




<section class="mailing">
	<div class="container">
		<div class="mailing__wrap">
			<div class="mailing__title">
				SIGN UP FOR OUR NEWSLETTER
			</div>
			<div class="mailing__desc">
				Get 10 % off on your first order
			</div>
			<form class="mailing__form" action="<?= POST_FORM_ACTION_URI ?>" method="post">
				<?= bitrix_sessid_post() ?>
				<input type="text" placeholder="your email" class="mailing__input" name="user_email">
				<input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
				<input type="submit" value="subscribe" class="mailing__submit" name="submit">
				<div class="mailing__agree">
					BY SUBSCRIBING YOU ACCEPT OUR <a href="#">PRIVACY POLICY</a>
				</div>
				<div class="mailing__desc">
					<? if (!empty($arResult["ERROR_MESSAGE"])) {
						foreach ($arResult["ERROR_MESSAGE"] as $v)
							ShowError($v);
					}
					if ($arResult["OK_MESSAGE"] <> '') : ?>
						<?= $arResult["OK_MESSAGE"] ?>
					<? endif ?>
				</div>
			</form>
		</div>
	</div>
</section>