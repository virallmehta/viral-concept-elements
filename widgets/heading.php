<?php
use Elementor\Widget_Base;
use Elementor\Icons_Manager;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography as Scheme_Typography;

defined( 'ABSPATH' ) || die( "Can't access directly" ); 

class Heading extends Widget_Base {

    public function get_name() {
        return 'sheading';
    }

    public function get_title() {
        return __( 'Viral Concept Heading', VCE_PLUGIN_NAME );
    }

    public function get_icon() {
		return 'eicon-heading';
	}

    public function get_categories() {
		return [ 'viral-concepts-elements' ];
	}

    protected function _register_controls() {

		//Content Service box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', VCE_PLUGIN_NAME ),
			]
		);

		$this->add_control(
			'iheading_title',
			[
				'label' => __( 'Subtitle & Title', VCE_PLUGIN_NAME ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'sub',
			[
				'label' => '',
				'type' => Controls_Manager::TEXT,
				'default' => __( 'OUR SERVICE', VCE_PLUGIN_NAME ),
				'placeholder' => __( 'Enter your subtitle', VCE_PLUGIN_NAME ),
				'label_block' => true,
				'show_label' => false,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'What we do', VCE_PLUGIN_NAME ),
				'placeholder' => __( 'Enter your title', VCE_PLUGIN_NAME ),
				'show_label' => false,
				'label_block' => true,
			]
		);
		$this->add_control(
			'light',
			[
				'label' => __( 'Text light', VCE_PLUGIN_NAME ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', VCE_PLUGIN_NAME ),
				'label_off' => __( 'No', VCE_PLUGIN_NAME ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'Alignment', VCE_PLUGIN_NAME ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', VCE_PLUGIN_NAME ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', VCE_PLUGIN_NAME ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', VCE_PLUGIN_NAME ),
						'icon' => 'fa fa-align-right',
					],
				],
				// 'prefix_class' => 'systop%s-align-',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default' => 'left',
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Heading', VCE_PLUGIN_NAME ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Subtitle
		$this->add_control(
			'heading_stitle',
			[
				'label' => __( 'Subtitle', VCE_PLUGIN_NAME ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'stitle_color',
			[
				'label' => __( 'Color', VCE_PLUGIN_NAME ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .vce-heading h6 span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .vce-heading h6:before, {{WRAPPER}} .vce-heading h6:after' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'stitle_typography',
				'selector' => '{{WRAPPER}} .vce-heading h6',
			]
		);
		$this->add_responsive_control(
			'stitle_bottom_space',
			[
				'label' => __( 'Spacing', VCE_PLUGIN_NAME ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .vce-heading h6' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', VCE_PLUGIN_NAME ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', VCE_PLUGIN_NAME ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .vce-heading h2' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .vce-heading h2',
			]
		);
		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => __( 'Spacing', VCE_PLUGIN_NAME ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .vce-heading h2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="vce-heading <?php echo $settings['text_align'] . '-align'; if( $settings['light'] === 'yes' ) echo ' text-light'; ?>">
	        <?php if( !empty($settings['sub']) ) { ?>
	            <h6><span><?php echo $settings['sub']; ?></span></h6>
	        <?php }if($settings['title']) { ?>
	        <h2 class="main-heading"><?php echo $settings['title']; ?></h2>
	        <?php } ?>
	    </div>
	    <?php
	}

	protected function _content_template() {}
}