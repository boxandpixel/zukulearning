<?php
// $question_of_the_day_teaser = get_field('question_of_the_day_teaser');
$question_of_the_day_teaser = $args['question_of_the_day_teaser'] ?? get_field('question_of_the_day_teaser');
$heading = $question_of_the_day_teaser['heading'];
$description = $question_of_the_day_teaser['description'];
$image = $question_of_the_day_teaser['image'];
$link = $question_of_the_day_teaser['link'];
$link_target = $link['target'] ? $link['target'] : '_self';
?>

<section class="question-of-the-day-teaser">
    <div class="container">
        <div class="question-of-the-day-teaser__details">
            <h2 class="question-of-the-day-teaser__heading"><?= $heading; ?></h2>
            <div class="question-of-the-day-teaser__description">
                <?= $description; ?>
            </div>
            <a href="<?= esc_url($link['url']); ?>" target="<?= esc_url($link_target); ?>" class="button button--primary-fill"><?= $link['title']; ?></a>
        </div>
        <div class="question-of-the-day-teaser__image">
            <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>">
        </div>
    </div>
</section>
