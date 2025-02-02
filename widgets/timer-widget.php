<?php

class Elementor_Timer_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return "TimerWidget";
	}

	public function get_title() {
		return __( "Timer Widget", 'Timer-Element' );
	}

	public function get_icon() {
		return 'fa fa-clock-o';
	}

	public function get_categories() {
		return array( 'general' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'Timer-Element' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control( 'display_type', [
			'label'   => __( 'Display Type', 'Timer-Element' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => [
				'clock'    => __( 'Clock', 'Timer-Element' ),
				'timerc'   => __( 'Time CountDown', 'Timer-Element' ),
				'genericc' => __( 'Normal CountDown', 'Timer-Element' ),
			],
			'default' => 'clock'
		] );

		$this->add_control( 'clock_format', [
			'label'     => __( 'Clock Format', 'Timer-Element' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'options'   => [
				'12' => __( '12 Hour', 'Timer-Element' ),
				'24' => __( '24 Hour', 'Timer-Element' ),
			],
			'default'   => '12',
			'condition' => [
				'display_type' => 'clock'
			]
		] );

		$this->add_control(
			'target_clock_time',
			[
				'label' => __( 'Target Time', 'Timer-Element' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
				'condition' => [
					'display_type' => 'timerc',
				],
				'label_block'=>false
			]
		);

		$this->add_control(
			'generic_countdown',
			[
				'label' => __( 'Target Time', 'Timer-Element' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'condition' => [
					'display_type' => 'genericc',
				],
				'label_block'=>false
			]
		);

		$this->add_control(
			'decrement',
			[
				'label' => __( 'Decrease By (milliseconds)', 'Timer-Element' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'condition' => [
					'display_type' => 'genericc',
				],
				'label_block'=>false,
				'default'=>1000
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$display_type = $this->get_settings('display_type');
		$clock_format = $this->get_settings('clock_format');
		$target_time = $this->get_settings('target_clock_time');
		$countdown = $this->get_settings('generic_countdown');
		$decrement = $this->get_settings('decrement');
		?>
		
        <div class="clock"
             data-display-type="<?php echo $display_type ?>"
             data-clock-format="<?php echo $clock_format ?>"
             data-target-time="<?php echo $target_time ?>"
             data-countdown="<?php echo $countdown ?>"
             data-decrement="<?php echo $decrement ?>"
        >
		</div>
		<?php
	}

	protected function _content_template() {}
}