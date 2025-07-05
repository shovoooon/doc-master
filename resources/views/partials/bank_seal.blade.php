<style>
    .bankstamp-container {
        filter: url(#ink-smudge);
    }

    .bankstamp {
        font-family: 'Arial', sans-serif;
        color: #470077;
        text-align: center;
        padding: 10px 20px;
        display: inline-block;
        box-shadow: 0 0 1px #0002;
    }

    .bankstamp h1 {
        font-size: 20px;
        font-weight: bold;
        margin: 0;
        letter-spacing: 1px;
    }

    .bankstamp p {
        font-size: 16px;
        margin: 2px 0;
        line-height: 1.3;
    }

</style>

<div class="bankstamp-container" id="bankstampContainer">
    <canvas class="noise" id="noiseCanvas" width="800" height="600"></canvas>
    <div class="bankstamp" id="bankstamp">
        <h1>MD ASHRAFUL ISLAM</h1>
        <p>Senior Assistant Vice President</p>
        <p>City Bank PLC, Rajshahi Branch</p>
    </div>

    <!-- SVG Filter for ink smudge -->
    <svg width="0" height="0">
        <filter id="ink-smudge">
            <feTurbulence type="fractalNoise" baseFrequency="0.9" numOctaves="2" result="noise" />
            <feDisplacementMap in="SourceGraphic" in2="noise" scale="2" />
            <feGaussianBlur stdDeviation="0.4" />
        </filter>
    </svg>
</div>


    


    <script>
        // Random rotation/skew
        const bankstamp = document.getElementById('bankstamp');
        if (bankstamp) {
            const angle = (Math.random() * 3 - 1.5).toFixed(2);
            const skew = (Math.random() * 1 - 0.5).toFixed(2);
            bankstamp.style.transform = `rotate(${angle}deg) skew(${skew}deg, ${-skew}deg)`;
        }
    </script>           