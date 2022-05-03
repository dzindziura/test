<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
      <div class="row">
<h1 class="mb-5 mt-5">3 останніх поста</h1>
          <?php
              global $post;

              $myposts = get_posts( [
              	'posts_per_page' => 3,
                'orderby'     => 'date',
	              'order'       => 'DESC',
              	'category_name' => '',
              	'post_type' => 'post',
              ] );

              foreach( $myposts as $post ){
              	setup_postdata( $post );
              	?>
                <div class="col-4">
                  <div style="border: 1px solid red">
                  <div><?php  echo get_the_post_thumbnail( $post->ID, array(400,400) )?></div>
              		<div><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                  <div>Автор: <?php the_author(); ?></div>
                  <div>Дата: <?php echo get_the_date('d/m/Y'); ?></div>
                </div>
                </div>
              	<?php
              }
              wp_reset_postdata();
              ?>
<h1 class="mb-5 mt-5">3 популярних поста</h1>
<?php
$popularpost = new WP_Query( array( 'posts_per_page' => 4, 'meta_key' => 'devise_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
while ( $popularpost->have_posts() ) : $popularpost->the_post();

the_title();

endwhile;
?>
                  <div class="populargb row">
                  <?php $populargb = new WP_Query('showposts=5&meta_key=post_views_count&orderby=meta_value_num' );
                  while ( $populargb->have_posts() ) {
                    $content = get_the_content();
                      $populargb->the_post(); ?>
                    <div class="col-4">
                      <div>
                        <div><?php  echo getPostViews(get_the_ID()); ?></div>
                      <h3><?php the_title(); ?></h3>
                      <div><?php echo mb_strimwidth($content, 0, 100); ?></div>
                      <div><a href="<?php the_permalink(); ?>">Читать дальше</a></div>


                    </div style="border: 1px solid red">
                    </div>
                  <?php } ?>
                </div>
      </div>
      <form role="form" method="post" action="">
      <div class="d-flex justify-content-center"><h1 class="mb-5 mt-5">Форма підписки</h1></div>
      <div><h3>Введіть ваш емейл</h3><input class="email_info form-control mb-5"/></div>
      <button type="button" class="form-control mb-5" id="send_mail">Відправити</button>
    </form>
      <script>
        $('#send_mail').click(function(){
          let email = $('.email_info').val();
          // alert(email);
          $.ajax({
                  url: "",
                  type: "POST",
                  data: {email: email},
                  success: function(data){
                    alert(email);
                  }
              });
        })
      </script>

      <?php
      global $wpdb;
      if(!empty($_POST['email'])){
        $table = $wpdb->prefix.'Email';
        $data = array('email' => $_POST['email']);
        $format = array('%s','%d');
        $wpdb->insert($table,$data,$format);
        $my_id = $wpdb->insert_id;
      }

       ?>


    </main><!-- .site-main -->
	</div><!-- .content-area -->

<?php
get_footer();
