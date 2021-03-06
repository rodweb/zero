<?php
namespace B7KP\Form;

use B7KP\Library\Route;
use B7KP\Library\Options;
use B7KP\Library\Lang;

class CertForm extends Form
{

	function __construct(){}

    /**
     * @param bool $obj
     * @throws \Exception
     */
    public function build($obj = false)
	{
		$this->obj = $obj;
		$options = new Options();
		$cert = $options->get("\B7KP\Entity\Settings", "show_cert");
		$certch = $options->get("\B7KP\Entity\Settings", "show_chart_cert");
		$plaq = $options->get("\B7KP\Entity\Settings", "show_plaque");
		$type = $options->get("\B7KP\Entity\Settings", "cert_type");
		$pts = $options->get("\B7KP\Entity\Settings", "show_points");
		$wcr = $options->get("\B7KP\Entity\Settings", "show_wkl_cert");
		$plaqtype = $options->get("\B7KP\Entity\Settings", "plaque_type");
		$form = $this
			->init(Route::url("change_settings"))
			->add(self::TYPE_SELECT, "show_cert", "form-control", $cert, "use_cert")
			->add(self::COMMENT, "cert_exp", "form-group text-justify text-muted")
			->add(self::TYPE_SELECT, "cert_type", "form-control", $type, "cert_type")
			->add(self::COMMENT, "alb_cert", "form-group text-center")
			->add(self::COMMENT, "gold", "form-group text-center no-margin")
			->add(self::TYPE_TEXT, "alb_cert_gold", "form-control")
			->add(self::COMMENT, "plat", "form-group text-center no-margin")
			->add(self::TYPE_TEXT, "alb_cert_platinum", "form-control")
			->add(self::COMMENT, "diam", "form-group text-center no-margin")
			->add(self::TYPE_TEXT, "alb_cert_diamond", "form-control")
			->add(self::COMMENT, "mus_cert", "form-group text-center")
			->add(self::COMMENT, "gold", "form-group text-center no-margin")
			->add(self::TYPE_TEXT, "mus_cert_gold", "form-control")
			->add(self::COMMENT, "plat", "form-group text-center no-margin")
			->add(self::TYPE_TEXT, "mus_cert_platinum", "form-control")
			->add(self::COMMENT, "diam", "form-group text-center no-margin")
			->add(self::TYPE_TEXT, "mus_cert_diamond", "form-control")
            ->add(self::COMMENT, "weights", "form-group text-center")
            ->add(self::COMMENT, "weight_alb_pls", "form-group text-center no-margin")
            ->add(self::TYPE_TEXT, "weight_alb_pls", "form-control numb")
            ->add(self::COMMENT, "weight_alb_pts", "form-group text-center no-margin")
            ->add(self::TYPE_TEXT, "weight_alb_pts", "form-control numb")
            ->add(self::COMMENT, "weight_mus_pls", "form-group text-center no-margin")
            ->add(self::TYPE_TEXT, "weight_mus_pls", "form-control numb")
            ->add(self::COMMENT, "weight_mus_pts", "form-group text-center no-margin")
            ->add(self::TYPE_TEXT, "weight_mus_pts", "form-control numb")
            ->add(self::TYPE_SELECT, "show_plaque", "form-control", $plaq, "use_plaque")
            ->add(self::TYPE_SELECT, "plaque_type", "form-control", $plaqtype, "plaque_type")
            ->add(self::COMMENT, "cert_name_exp", "form-group text-center no-margin")
            ->add(self::TYPE_TEXT, "cert_name", "form-control")
            ->add(self::COMMENT, "custom_unity_exp", "form-group text-center no-margin")
            ->add(self::TYPE_TEXT, "custom_unity", "form-control")
            ->add(self::TYPE_SELECT, "show_chart_cert", "form-control", $certch, "use_cert_cha")
			->add(self::TYPE_SELECT, "show_wkl_cert", "form-control", $wcr, "show_wkl_cert")
			->add(self::TYPE_SUBMIT, "save", "send btn btn-success")
			->end();
	}
}
