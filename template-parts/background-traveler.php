<?php
/**
 * Background Traveler Component - Layered Cube
 */
?>
<div id="bg-traveler-container" class="bg-traveler-container">
    <svg class="layered-cube" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="cubeGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:var(--color-primary); stop-opacity:0.2" />
                <stop offset="100%" style="stop-color:var(--color-primary-light); stop-opacity:0.05" />
            </linearGradient>
        </defs>

        <!-- Isometric Cube Faces -->
        <path d="M100 30 L160 60 L100 90 L40 60 Z" class="cube-top" />
        <path d="M40 60 L100 90 L100 170 L40 140 Z" class="cube-left" />
        <path d="M160 60 L100 90 L100 170 L160 140 Z" class="cube-right" />

        <!-- Printing Layers (Lines) -->
        <g class="cube-layers">
            <?php for ($i = 0; $i < 10; $i++): ?>
                <path
                    d="M40 <?php echo 60 + ($i * 8); ?> L100 <?php echo 90 + ($i * 8); ?> L160 <?php echo 60 + ($i * 8); ?>"
                    fill="none" stroke="var(--color-primary)" stroke-width="0.5" stroke-opacity="0.3" />
            <?php endfor; ?>
        </g>
    </svg>
</div>