/**
 * Print Factory - Frontend Logic & Animations
 * Organized into modules for better maintainability.
 */

(function ($) {
    'use strict';

    const App = {
        init: function () {
            this.setupNavigation();
            this.setupAnimations();
            this.setupSliders();
            this.setupForms();
            this.setupUIEffects();
        },

        // 1. NAVIGATION & SCROLL
        setupNavigation: function () {
            $('a[href^="#"]').on('click', function (e) {
                const target = $(this.hash);
                if (target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 20
                    }, 800);
                }
            });
        },

        // 2. ANIMATIONS (Intersection Observer & Text Splitting)
        setupAnimations: function () {
            const splitTextIntoChars = (element) => {
                const text = element.textContent.trim();
                element.innerHTML = '';
                element.setAttribute('aria-label', text);

                text.split(' ').forEach(word => {
                    const wordSpan = document.createElement('span');
                    wordSpan.className = 'split-word';

                    word.split('').forEach(char => {
                        const charSpan = document.createElement('span');
                        charSpan.className = 'split-char';
                        charSpan.textContent = char;
                        wordSpan.appendChild(charSpan);
                    });

                    element.appendChild(wordSpan);
                    element.appendChild(document.createTextNode(' '));
                });
            };

            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        $(el).find('.split-char').each(function (i) {
                            $(this).css('transition-delay', (i * 0.03) + 's');
                        });
                        el.classList.add('reveal-active');
                        revealObserver.unobserve(el);
                    }
                });
            }, { threshold: 0.1 });

            $('h1, h2, h3').each(function () {
                splitTextIntoChars(this);
                revealObserver.observe(this);
            });

            // Fade-up animation for blocks
            const fadeUpObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        fadeUpObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            $('.portfolio-item, .stage-item, .step-card, .stat-item').addClass('fade-up');
            $('.fade-up').each(function () {
                fadeUpObserver.observe(this);
            });
        },

        // 3. SLIDERS (Hero, etc.)
        setupSliders: function () {
            const $hero = $('.hero-slider');
            if (!$hero.length) return;

            let currentSlide = 0;
            const slides = $('.hero-slide');
            const dots = $('.hero-dot');
            const slideCount = slides.length;
            let slideInterval;

            const loadHeroImage = ($slide) => {
                const $bg = $slide.find('.hero-bg');
                if ($bg.data('bg-large') && $bg.hasClass('low-res')) {
                    const largeUrl = $bg.data('bg-large');
                    const img = new Image();
                    img.onload = () => {
                        $bg.css('background-image', `url('${largeUrl}')`).removeClass('low-res');
                    };
                    img.src = largeUrl;
                }
            };

            const showSlide = (index) => {
                slides.find('.animate-header').removeClass('reveal-active');
                slides.removeClass('active');
                dots.removeClass('active');

                const $nextSlide = slides.eq(index);
                $nextSlide.addClass('active');
                dots.eq(index).addClass('active');

                loadHeroImage($nextSlide);
                setTimeout(() => {
                    $nextSlide.find('.animate-header').addClass('reveal-active');
                }, 50);

                currentSlide = index;
            };

            const startTimer = () => {
                clearInterval(slideInterval);
                slideInterval = setInterval(() => {
                    showSlide((currentSlide + 1) % slideCount);
                }, 6000);
            };

            dots.on('click', function () {
                showSlide($(this).data('index'));
                startTimer();
            });

            startTimer();
            loadHeroImage(slides.eq(0));
        },

        // 4. FORMS & CALCULATOR
        setupForms: function () {
            const $calcOverlay = $('#calculator-overlay');
            const $calcForm = $('#calc-form');

            // Triggering calculator
            $('#calculator-trigger, #pricing-calc-trigger, .open-calc-trigger').on('click', function (e) {
                e.preventDefault();
                $calcOverlay.addClass('active');
                $('body').addClass('drawer-open');
            });

            $('#calc-close, #calculator-overlay').on('click', function (e) {
                if (e.target === this || $(e.target).hasClass('calc-close')) {
                    $calcOverlay.removeClass('active');
                    $('body').removeClass('drawer-open');
                }
            });

            // Price Calculation Logic
            const calculatePrice = () => {
                const material = $('#calc-material option:selected');
                const pricePerUnit = parseFloat(material.data('price')) || 0;
                const bulkPrice = parseFloat(material.data('bulk-price')) || 0;
                const density = parseFloat(material.data('density')) || 1.24;

                const w = parseFloat($('#calc-width').val()) || 0;
                const h = parseFloat($('#calc-height').val()) || 0;
                const d = parseFloat($('#calc-depth').val()) || 0;
                const infill = parseInt($('#calc-infill').val()) || 20;
                const qty = parseInt($('#calc-qty').val()) || 1;

                // 1. Surcharge for size
                const maxDim = Math.max(w, h, d);
                const surcharge = (maxDim > 256) ? 0.10 : 0;
                (maxDim > 256) ? $('.size-warning').fadeIn() : $('.size-warning').fadeOut();

                // 2. Weight Calculation
                const volumeCm3 = (w * h * d) / 1000;
                const weightPerUnit = volumeCm3 * density * (infill / 100);
                const totalWeight = weightPerUnit * qty;

                // 3. Base Price
                const activePrice = (qty >= 50) ? bulkPrice : pricePerUnit;
                let total = weightPerUnit * activePrice * qty;
                if (surcharge > 0) total += total * surcharge;

                // 4. Discounts
                const calcConfig = (window.PF_Config && window.PF_Config.calculator) ? window.PF_Config.calculator : {};
                const discConfig = calcConfig.discounts || {};
                let discount = 0;

                // Weight discount
                if (totalWeight >= (discConfig.weight_threshold_g || 500)) discount = discConfig.weight_discount_percent || 10;

                // Progressive Quantity discount
                const qProg = discConfig.quantity_progressive || { min_qty: 100, max_qty: 10000, min_discount: 10, max_discount: 30 };
                if (qty >= qProg.min_qty) {
                    let qDiscount = (qty >= qProg.max_qty) ? qProg.max_discount :
                        qProg.min_discount + (qProg.max_discount - qProg.min_discount) * (qty - qProg.min_qty) / (qProg.max_qty - qProg.min_qty);
                    discount = Math.max(discount, qDiscount);
                }

                if (discount > 0) {
                    total *= (1 - discount / 100);
                    $('#discount-badge').show();
                    $('#discount-val').text(Math.round(discount * 10) / 10);
                } else {
                    $('#discount-badge').hide();
                }

                // 5. Min Order
                const minOrder = calcConfig.min_order_amount || 150;
                if (total > 0 && total < minOrder) {
                    total = minOrder;
                    $('#min-order-warning').fadeIn();
                } else {
                    $('#min-order-warning').fadeOut();
                }

                $('#calc-total-price').text(total.toLocaleString('uk-UA', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' грн');
                $('#infill-val').text(infill);

                if (weightPerUnit > 0) {
                    $('#calc-weight-val').text(totalWeight.toLocaleString('uk-UA', { maximumFractionDigits: 1 }));
                    $('#calc-weight-display').show();
                } else {
                    $('#calc-weight-display').hide();
                }
            };

            // Input handling
            $('#calc-width, #calc-height, #calc-depth').on('input', function () {
                if ($(this).val() > 2560) $(this).val(2560);
                calculatePrice();
            }).on('blur', function () {
                if ($(this).val() < 1 || isNaN($(this).val())) $(this).val(1);
                calculatePrice();
            });

            $('#calc-form input, #calc-form select').on('input change', calculatePrice);

            // AJAX Submission
            $calcForm.on('submit', function (e) {
                e.preventDefault();
                const $btn = $('#calc-submit');
                const originalText = $btn.text();
                $btn.prop('disabled', true).text('Відправка...');

                const formData = new FormData(this);
                formData.append('action', 'handle_calculator');
                formData.append('total_price', $('#calc-total-price').text());

                $.ajax({
                    url: '/wp-admin/admin-ajax.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success) {
                            alert(response.data);
                            $calcOverlay.removeClass('active');
                            $('body').removeClass('drawer-open');
                            $calcForm[0].reset();
                            $('#calc-step-2, .step-dot[data-step="2"]').removeClass('active');
                            $('#calc-step-1').addClass('active');
                            $('#calc-total-price').text('0.00 грн');
                        } else {
                            alert('Помилка: ' + response.data);
                        }
                    },
                    error: () => alert('Помилка при відправці. Спробуйте пізніше.'),
                    complete: () => $btn.prop('disabled', false).text(originalText)
                });
            });

            // Contact messenger toggle
            $('input[name="messenger"]').on('change', function () {
                const isEmail = ($(this).val() === 'email');
                isEmail ? $('#email-field-group').fadeIn() : $('#email-field-group').fadeOut();
                $('#calc-email').prop('required', isEmail);
            });

            // Steps
            $('#to-step-2').on('click', () => {
                if ($('#calc-material').val() && $('#calc-width').val() && $('#calc-height').val() && $('#calc-depth').val()) {
                    $('#calc-step-1').removeClass('active');
                    $('#calc-step-2, .step-dot[data-step="2"]').addClass('active');
                } else alert('Заповніть всі параметри.');
            });

            $('#back-to-step-1').on('click', () => {
                $('#calc-step-2, .step-dot[data-step="2"]').removeClass('active');
                $('#calc-step-1').addClass('active');
            });
        },

        // 5. ADDITIONAL UI
        setupUIEffects: function () {
            // FAQ
            $('.faq-question').on('click', function () {
                const item = $(this).closest('.faq-item').toggleClass('active');
                $(this).find('.faq-icon').text(item.hasClass('active') ? '−' : '+');
            });

            // Payment
            $('.pay-tab').on('click', function () {
                $('.pay-tab').removeClass('active');
                $(this).addClass('active');
                $('.pay-content').hide();
                $(`#pay-${$(this).data('target')}`).fadeIn();
            });

            // Section Mood Observer
            const moodObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && entry.target.id) {
                        document.body.classList.forEach(cls => { if (cls.startsWith('section-')) document.body.classList.remove(cls); });
                        document.body.classList.add(`section-${entry.target.id}`);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('section, header.site-header').forEach(el => moodObserver.observe(el));
        }
    };

    $(document).ready(() => App.init());

})(jQuery);
