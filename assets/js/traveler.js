/**
 * Background Traveler Logic - Wave Movement
 */
(function ($) {
    'use strict';

    const Traveler = {
        element: null,
        winHeight: 0,
        docHeight: 0,

        init: function () {
            this.element = $('.layered-cube');
            if (!this.element.length) return;

            this.updateDimensions();
            this.bindEvents();
            this.move();
        },

        updateDimensions: function () {
            this.winHeight = $(window).height();
            this.docHeight = $(document).height();
        },

        bindEvents: function () {
            $(window).on('scroll', () => this.move());
            $(window).on('resize', () => {
                this.updateDimensions();
                this.move();
            });
        },

        move: function () {
            const scrollTop = $(window).scrollTop();
            const scrollPercent = scrollTop / (this.docHeight - this.winHeight);

            // 1. Continuous Floating Path (Sinusoidal)
            // x alternates between ~10% and 85%
            const x = 45 + Math.cos(scrollPercent * Math.PI * 2) * 40;

            // y goes from 15% to 85% with a slight wave
            const y = 15 + (scrollPercent * 70) + Math.sin(scrollPercent * Math.PI * 4) * 5;

            // 2. Rotation & Scale
            // Rotates 360deg over full scroll + subtle wobble
            const rotate = (scrollPercent * 360) + Math.sin(scrollPercent * 10) * 15;
            const scale = 0.9 + Math.sin(scrollPercent * Math.PI * 3) * 0.3;

            // 3. Dynamic Opacity (0.4 to 0.6 range)
            const opacity = 0.4 + Math.abs(Math.sin(scrollPercent * Math.PI * 2)) * 0.2;

            // Apply transformations
            this.element.css({
                'transform': `translate(${x}vw, ${y}vh) rotate(${rotate}deg) scale(${scale})`,
                'opacity': opacity
            });
        }
    };

    $(document).ready(() => Traveler.init());

})(jQuery);
