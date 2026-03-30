<?php
/**
 * Template part for displaying Portfolio section
 */
$content = $args['content'] ?? [];
?>
<section id="portfolio" class="section-padding"> <!-- Removed overflow-hidden -->
    <div class="container">
        <div class="text-left mb-5">
            <h2 class="animate-header" data-aos="fade-up">
                <?php echo esc_html($content['portfolio']['title']); ?>
            </h2>
            <p class="section-subtitle" style="margin-left: 0; text-align: left;" data-aos="fade-up"
                data-aos-delay="100">
                <?php echo esc_html($content['portfolio']['subtitle']); ?>
            </p>
        </div>

        <!-- Slider Container -->
        <div class="portfolio-slider-container relative" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper portfolio-swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($content['portfolio']['items'] as $item): ?>
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image">
                                    <img src="<?php echo esc_url($item['image']); ?>"
                                        alt="<?php echo esc_attr($item['title']); ?>" loading="lazy">
                                    <div class="project-overlay"></div>

                                    <!-- Badges Overlay -->
                                    <div class="project-badges">
                                        <span class="badge-tech"><?php echo esc_html($item['tech']); ?></span>
                                        <span class="badge-term"><?php echo esc_html($item['term']); ?></span>
                                        <?php if (!empty($item['quantity'])): ?>
                                            <span class="badge-qty"><?php echo esc_html($item['quantity']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="project-content">
                                    <h3 class="project-title"><?php echo esc_html($item['title']); ?></h3>

                                    <div class="project-specs">
                                        <div class="spec-item">
                                            <i class="fa-solid fa-layer-group"></i>
                                            <span><?php echo esc_html($item['material']); ?></span>
                                        </div>
                                        <div class="spec-item">
                                            <i class="fa-solid fa-weight-hanging"></i>
                                            <span><?php echo esc_html($item['weight']); ?></span>
                                        </div>
                                    </div>

                                    <!-- Flex Footer for Desc + Button -->
                                    <div class="project-card-footer">
                                        <p class="project-desc"><?php echo esc_html($item['description']); ?></p>

                                        <button class="btn-project-calc"
                                            onclick="openCalculatorWithParams('<?php echo esc_js($item['material']); ?>', '<?php echo esc_js($item['title']); ?>', '<?php echo esc_js($item['quantity'] ?? '1'); ?>')"
                                            aria-label="Розрахувати подібний проект">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="swiper-pagination"></div>
            </div>

            <!-- Navigation Buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.portfolio-swiper', {
            slidesPerView: 1.2,
            centeredSlides: true,
            spaceBetween: 20,
            loop: true,
            loopedSlides: 18, // Match number of items for loop stability
            grabCursor: true,
            slideToClickedSlide: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 2.8, // Slightly more items visible to keep centering nice
                    spaceBetween: 30,
                },
                1400: {
                    slidesPerView: 3.2,
                    spaceBetween: 40,
                }
            }
        });
    });

    function openCalculatorWithParams(material, title, quantity) {
        console.log('OpenCalc', material, title, quantity); // Debug

        // Target BOTH the overlay ID (to show it) and modal (for sanity)
        const overlay = document.getElementById('calculator-overlay');

        if (overlay) {
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';

            // Find Inputs INSIDE the overlay
            const commentField = overlay.querySelector('textarea[name="comment"]');
            const qtyInput = overlay.querySelector('input[name="qty"]'); // Should be id="calc-qty" usually
            const materialSelect = overlay.querySelector('select[name="material"]');

            // 1. Fill Comment
            if (commentField) {
                commentField.value = `> Хочу замовити схоже на: "${title}"\n> Матеріал: ${material}, Кількість: ${quantity}`;
            }

            // 2. Fill Quantity
            if (qtyInput && quantity) {
                // Remove non-digits (e.g. "500 шт" -> 500)
                let cleanQty = parseInt(quantity.replace(/[^0-9]/g, ''));
                if (cleanQty > 0) {
                    qtyInput.value = cleanQty;
                } else {
                    qtyInput.value = 1;
                }
            }

            // 3. Select Material
            if (materialSelect) {
                // Normalize search term
                const search = material.toLowerCase();

                // Try exact match then partial
                let found = false;

                // Array.from for compatibility
                Array.from(materialSelect.options).forEach((opt, index) => {
                    if (found) return;
                    const optText = opt.text.toLowerCase();
                    const optVal = opt.value.toLowerCase();

                    if (optVal.includes(search) || optText.includes(search) || search.includes(optVal)) {
                        materialSelect.selectedIndex = index;
                        found = true;
                    }
                });
            }
        } else {
            console.error('Calculator overlay not found ID: calculator-overlay');
        }
    }
</script>