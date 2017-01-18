<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 09/12/2016
 * Time: 13:38
 */

/**
 * Enqueue styles
 */
function tickalo_enqueue_styles() {
	$parent_style = 'mp-profit-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'tickalo-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_style( 'tickalo-style-main', get_stylesheet_directory_uri() . '/css/tickalo-style.min.css', array( 'mp-profit-main' ), mp_profit_get_theme_version(), 'all' );
	wp_enqueue_script( 'mp-tickalo-script', get_stylesheet_directory_uri() . '/js/tickalo.min.js', array( 'jquery' ), mp_profit_get_theme_version(), true );
}

add_action( 'wp_enqueue_scripts', 'tickalo_enqueue_styles' );

/* ****************** PUNTOS DE VENTA ******************  */
/**
 * Add Punto de Venta custom post type
 */
function tickalo_punto_de_venta_register() {
	$args = array(
		'label'           => __( 'Puntos de Venta', 'mp-profit' ),
		'singular_label'  => __( 'Punto de Venta', 'mp-profit' ),
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'rewrite'         => true,
		'supports'        => array( 'title', 'editor', 'thumbnail' )
	);
	register_post_type( 'puntos-de-venta', $args );
}

add_action( 'init', 'tickalo_punto_de_venta_register' );

/**
 * Add Puntos de Venta custom html
 */
function tickalo_punto_de_venta_get_html() {
	?>
	<section id="puntos-de-venta" class="services-section white-section default-section">
		<div class="container">
			<div class="section-content">
				<!-- Title -->
				<h2 class="section-title">Puntos de Venta</h2>

				<!-- Subtitle -->
				<div class="section-subtitle">Soluciones Profesionales para todo tipo de Negocio</div>

				<!-- Puntos de Venta list -->
				<?php
				$args   = array(
					'post_type'      => 'puntos-de-venta',
					'posts_per_page' => 6
				);
				$prizes = new WP_Query( $args );
				if ( $prizes->have_posts() ) {
					?>
					<div class="service-list">
						<div class="row">
							<?php
							$i = 0;
							while ( $prizes->have_posts() ) {
								$prizes->the_post();
								if ( $i == 3 ):
									echo '<div class = "clearfix visible-lg-block visible-md-block visible-sm-block"></div >';
								endif;
								?>
								<div class="service-box  col-xs-6 col-sm-4 col-md-4 col-lg-4">
									<a href="<?php the_permalink(); ?>" class="service-content">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( 'mp-profit-thumb-related' );
										} else {
											?>
											<div class="service-empty-thumbnail">
												<span class="date-post"><?php the_time( 'F j, Y' ); ?></span>
											</div>
											<?php
										}
										?>
										<div class="service-hover">
											<div class="hover-content">
												<div>
													<h5 class="service-title"><?php the_title(); ?></h5>
													<hr class="service-line">
													<div class="service-entry">
														<?php the_excerpt(); ?>
													</div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<?php
								$i++;
							}
							?>
						</div>
					</div>
					<?php
				} ?>

			</div>
		</div>
	</section>
	<?php
}

add_action( 'tickalo_section_punto_de_venta', 'tickalo_punto_de_venta_get_html' );


/* ****************** SECTORES ******************  */
/**
 * Add Sector custom post type
 */
function tickalo_sectores_register() {
	$args = array(
		'label'           => __( 'Sectores', 'mp-profit' ),
		'singular_label'  => __( 'Sector', 'mp-profit' ),
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'rewrite'         => true,
		'supports'        => array( 'title', 'editor', 'thumbnail' )
	);
	register_post_type( 'sector', $args );
}

add_action( 'init', 'tickalo_sectores_register' );

/**
 * Add Sectores custom html
 */
function tickalo_sectores_get_html() {
	?>
	<section id="sectores" class="services-section white-section default-section">
		<div class="container">
			<div class="section-content">
				<!-- Title -->
				<h2 class="section-title">Sectores</h2>

				<!-- Subtitle -->
				<div class="section-subtitle">Un subtítulo glorioso</div>

				<!-- Sectores list -->
				<?php
				$args   = array(
					'post_type'      => 'sector',
					'posts_per_page' => 4
				);
				$prizes = new WP_Query( $args );
				if ( $prizes->have_posts() ) {
					?>
					<div class="service-list">
						<div class="row">
							<?php
							$i = 0;
							while ( $prizes->have_posts() ) {
								$prizes->the_post();
								if ( $i == 4 ):
									echo '<div class = "clearfix visible-lg-block visible-md-block visible-sm-block"></div >';
								endif;
								?>
								<div class="service-box  col-xs-6 col-sm-3 col-md-3 col-lg-3">
									<a href="<?php the_permalink(); ?>" class="service-content">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( 'mp-profit-thumb-related' );
										} else {
											?>
											<div class="service-empty-thumbnail">
												<span class="date-post"><?php the_time( 'F j, Y' ); ?></span>
											</div>
											<?php
										}
										?>
										<div class="service-hover">
											<div class="hover-content">
												<div>
													<h5 class="service-title"><?php the_title(); ?></h5>
													<hr class="service-line">
													<div class="service-entry">
														<?php the_excerpt(); ?>
													</div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<?php
								$i++;
							}
							?>
						</div>
					</div>
					<?php
				} ?>

			</div>
		</div>
	</section>
	<?php
}

add_action( 'tickalo_section_sectores', 'tickalo_sectores_get_html' );

/* ****************** SEGURIDAD ******************  */
/**
 * Add Seguridad custom post type
 */
function tickalo_seguridad_register() {
	$args = array(
		'label'           => __( 'Seguridad', 'mp-profit' ),
		'singular_label'  => __( 'Seguridad', 'mp-profit' ),
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'rewrite'         => true,
		'supports'        => array( 'title', 'editor', 'thumbnail' )
	);
	register_post_type( 'seguridad', $args );
}

add_action( 'init', 'tickalo_seguridad_register' );

/**
 * Add Seguridad custom html
 */
function tickalo_seguridad_get_html() {
	?>
	<section id="seguridad" class="services-section seguridad-section white-section default-section">
		<div class="container">
			<div class="section-content">
				<!-- Title -->
				<h2 class="section-title">Seguridad</h2>

				<!-- Subtitle -->
				<div class="section-subtitle">Videovigilancia y controles de presencia</div>

				<!-- Seguridad list -->
				<?php
				$args   = array(
					'post_type'      => 'seguridad',
					'posts_per_page' => 2
				);
				$prizes = new WP_Query( $args );
				if ( $prizes->have_posts() ) {
					?>
					<div class="service-list">
						<div class="row">
							<?php
							$i = 0;
							while ( $prizes->have_posts() ) {
								$prizes->the_post();
								if ( $i == 2 ):
									echo '<div class = "clearfix visible-lg-block visible-md-block visible-sm-block"></div >';
								endif;
								?>
								<div class="service-box  col-xs-6 col-sm-6 col-md-6 col-lg-6">
									<a href="<?php the_permalink(); ?>" class="service-content">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( 'mp-profit-thumb-related' );
										} else {
											?>
											<div class="service-empty-thumbnail">
												<span class="date-post"><?php the_time( 'F j, Y' ); ?></span>
											</div>
											<?php
										}
										?>
										<div class="service-hover">
											<div class="hover-content">
												<div>
													<h5 class="service-title"><?php the_title(); ?></h5>
													<hr class="service-line">
													<div class="service-entry">
														<?php the_excerpt(); ?>
													</div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<?php
								$i++;
							}
							?>
						</div>
					</div>
					<?php
				} ?>

			</div>
		</div>
	</section>
	<?php
}

add_action( 'tickalo_section_seguridad', 'tickalo_seguridad_get_html' );