<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/header.php';

$sliders = $pdo->query("SELECT * FROM sliders WHERE status='active' ORDER BY order_no ASC")->fetchAll();
$sliderSpeed = $sliders[0]['speed'] ?? 5000;
$services = $pdo->query("SELECT * FROM services WHERE status='active' ORDER BY order_no ASC LIMIT 5")->fetchAll();
$welcome = $pdo->query("SELECT * FROM welcome_section WHERE id=1")->fetch();
$whyJoin = $pdo->query("SELECT * FROM why_join WHERE status='active' ORDER BY order_no ASC")->fetchAll();
$managementHome = $pdo->query("SELECT * FROM management WHERE show_home='yes' AND status='active' ORDER BY type ASC, order_no ASC")->fetchAll();
$testimonials = $pdo->query("SELECT * FROM testimonials WHERE status='active' ORDER BY order_no ASC LIMIT 10")->fetchAll();
?>

<?php if (count($sliders) > 0): ?>
<section class="hero-slider-section">
    <div class="swiper heroSwiper">
        <div class="swiper-wrapper">
            <?php foreach ($sliders as $slide): ?>
            <div class="swiper-slide">
                <div class="hero-slide" style="background-image:url('<?php echo $slide['image'] ? UPLOAD_URL.$slide['image'] : ''; ?>')">
                    <div class="hero-overlay"></div>
                    <div class="hero-content" data-aos="fade-up">
                        <h1><?php echo $lang=='bn' ? $slide['title_bn'] : $slide['title_en']; ?></h1>
                        <?php if (!empty($slide['subtitle_bn'])): ?>
                        <p><?php echo $lang=='bn' ? $slide['subtitle_bn'] : $slide['subtitle_en']; ?></p>
                        <?php endif; ?>
                        <div class="hero-btn-group">
                            <?php if (!empty($slide['button_text_bn'])): ?>
                            <a href="<?php echo $slide['button_link'] ?: '#'; ?>" class="hero-btn hero-btn-primary">
                                <?php echo $lang=='bn' ? $slide['button_text_bn'] : $slide['button_text_en']; ?>
                            </a>
                            <?php endif; ?>
                            <?php if (!empty($slide['button_text_bn2'])): ?>
                            <a href="<?php echo $slide['button_link2'] ?: '#'; ?>" class="hero-btn hero-btn-outline">
                                <?php echo $lang=='bn' ? $slide['button_text_bn2'] : $slide['button_text_en2']; ?>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>
<?php else: ?>
<section class="hero-placeholder">
    <div class="container text-center">
        <h2><?php echo $lang=='bn' ? 'এডমিন প্যানেল থেকে স্লাইডার যোগ করুন' : 'Add a slider from Admin Panel'; ?></h2>
    </div>
</section>
<?php endif; ?>

<!-- ===== সার্ভিস সেকশন ===== -->
<?php if (count($services) > 0): ?>
<section class="services-section py-5">
    <div class="container">
        <h3 class="section-title text-center" data-aos="fade-up"><?php echo $lang=='bn' ? 'আমাদের সার্ভিস সমূহ' : 'Our Services'; ?></h3>
        <div class="row g-4 mt-2">
            <?php foreach ($services as $i => $s): ?>
            <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="<?php echo $i*100; ?>">
                <div class="service-card-3d">
                    <div class="service-icon"><i class="bi <?php echo htmlspecialchars($s['icon']); ?>"></i></div>
                    <h5><?php echo $lang=='bn' ? $s['title_bn'] : $s['title_en']; ?></h5>
                    <p><?php echo $lang=='bn' ? $s['description_bn'] : $s['description_en']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ===== স্বাগতম সেকশন ===== -->
<?php if ($welcome): ?>
<section class="welcome-section py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                <h3 class="section-title"><?php echo $lang=='bn' ? $welcome['title_bn'] : $welcome['title_en']; ?></h3>
                <p class="welcome-desc"><?php echo nl2br($lang=='bn' ? $welcome['description_bn'] : $welcome['description_en']); ?></p>
            </div>
            <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                <?php if (!empty($welcome['image'])): ?>
                <div class="welcome-img-wrap">
                    <img src="<?php echo UPLOAD_URL . $welcome['image']; ?>" alt="Welcome" class="welcome-img">
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ===== কেন যোগ দিবে (সংখ্যা) সেকশন ===== -->
<?php if (count($whyJoin) > 0): ?>
<section class="why-join-section py-5">
    <div class="container">
        <h3 class="section-title text-center text-white" data-aos="fade-up"><?php echo $lang=='bn' ? 'কেন আমাদের সাথে যুক্ত হবেন' : 'Why Join Us'; ?></h3>
        <div class="row g-4 mt-2">
            <?php foreach ($whyJoin as $i => $w): ?>
            <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="<?php echo $i*100; ?>">
                <div class="why-join-card">
                    <i class="bi <?php echo htmlspecialchars($w['icon']); ?>"></i>
                    <h2><?php echo htmlspecialchars($w['number']); ?></h2>
                    <p><?php echo $lang=='bn' ? $w['title_bn'] : $w['title_en']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ===== ম্যানেজমেন্ট প্রিভিউ সেকশন ===== -->
<?php if (count($managementHome) > 0): ?>
<section class="py-5">
    <div class="container">
        <h3 class="section-title text-center" data-aos="fade-up"><?php echo $lang=='bn' ? 'আমাদের শিক্ষক ও উপদেষ্টাবৃন্দ' : 'Our Teachers & Advisors'; ?></h3>
        <div class="row g-4 mt-2">
            <?php foreach ($managementHome as $i => $m): ?>
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="<?php echo $i*80; ?>">
                <div class="member-card">
                    <div class="member-photo" style="background-image:url('<?php echo $m['photo'] ? UPLOAD_URL.$m['photo'] : BASE_URL.'assets/images/default-user.png'; ?>')"></div>
                    <h5><?php echo htmlspecialchars($m['name']); ?></h5>
                    <p><?php echo $lang=='bn' ? $m['designation_bn'] : $m['designation_en']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo BASE_URL; ?>management.php" class="btn-course-details"><?php echo $lang=='bn' ? 'সকলকে দেখুন' : 'View All'; ?></a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ===== টেস্টিমোনিয়াল স্লাইডার ===== -->
<?php if (count($testimonials) > 0): ?>
<section class="testimonial-section py-5">
    <div class="container">
        <h3 class="section-title text-center" data-aos="fade-up"><?php echo $lang=='bn' ? 'শিক্ষার্থী ও অভিভাবকদের মতামত' :'What Our Students & Parents Say about us'; ?></h3>
        <div class="swiper testimonialSwiper mt-4">
            <div class="swiper-wrapper">
                <?php foreach ($testimonials as $t): ?>
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <?php if ($t['photo']): ?>
                        <img src="<?php echo UPLOAD_URL . $t['photo']; ?>" class="testimonial-photo">
                        <?php endif; ?>
                        <div class="testimonial-stars"><?php echo str_repeat('★', $t['rating']) . str_repeat('☆', 5-$t['rating']); ?></div>
                        <p class="testimonial-msg">"<?php echo $lang=='bn' ? $t['message_bn'] : $t['message_en']; ?>"</p>
                        <p class="testimonial-name"><?php echo htmlspecialchars($t['name']); ?></p>
                        <p class="testimonial-role"><?php echo $lang=='bn' ? $t['role_bn'] : $t['role_en']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
<?php endif; ?>

<script>var swiperSpeed = <?php echo (int)$sliderSpeed; ?>;</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>