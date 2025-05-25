<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Stamp</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        #circle-svg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 10;
        }

        .dashed-border {
            stroke: rgb(150, 150, 150);
            stroke-width: 2;
            stroke-dasharray: 11, 9;
            fill: white;
        }

        #inner-ring {
            position: relative;
            z-index: 20;
            background-color: white;
        }
    </style>
</head>

<body>
    <div id="stamp"
        class="relative flex items-center bg-white justify-center border border-blue-700 rounded-full border-8">
        <svg id="circle-svg" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <path id="circlePath"></path>
            </defs>
            <circle id="dashed-border" class="dashed-border" cx="150" cy="150" r="0" />
            <circle id="outer-border" stroke="black" stroke-width="4" fill="white" cx="150" cy="150"
                r="0" />
            <text id="circular-text" fill="#555" font-size="12" font-family="'Roboto', Arial, sans-serif"
                text-anchor="middle" letter-spacing="3" font-weight="bold">
                <textPath href="#circlePath" startOffset="50%" dominant-baseline="middle">
                    JAYA VENTURES (PJ) SDN. BHD.
                </textPath>
            </text>
            <text id="fixed-star" fill="#555" font-size="12" font-family="'Roboto', Arial, sans-serif"
                text-anchor="middle" dominant-baseline="middle" pointer-events="none" x="150" y="90">★</text>
        </svg>
        <div id="inner-ring" class="flex items-center justify-center border rounded-full border-black border-4">
            <div class="flex flex-col justify-center items-center text-gray-900 p-2 text-center"
                style="font-family: 'Roboto', sans-serif; font-size: 10px;">
                <span>199301030815</span>
                <span style="font-size: 12px;">(285554-A)</span>
            </div>
        </div>
    </div>

    <script>
        function adjustRingSize() {
            const textElement = document.querySelector('textPath');
            const textLength = textElement.getComputedTextLength();

            const minDiameter = 80;
            const maxDiameter = 1000;
            const calculatedDiameter = Math.ceil(textLength / Math.PI) + 30;

            const diameter = Math.min(Math.max(minDiameter, calculatedDiameter), maxDiameter);
            const radius = diameter / 2;
            const dashedRadius = radius * 1.1;
            const innerDiameter = diameter * 0.6;
            const textRadius = diameter * 0.75 / 2;

            const svg = document.getElementById('circle-svg');
            const svgSize = diameter * 1.2;
            svg.setAttribute('width', svgSize);
            svg.setAttribute('height', svgSize);
            svg.setAttribute('viewBox', `0 0 ${svgSize} ${svgSize}`);

            const centerX = svgSize / 2;
            const centerY = svgSize / 2;

            const circlePath = document.getElementById('circlePath');
            circlePath.setAttribute(
                'd',
                `M ${centerX}, ${centerY - textRadius} a ${textRadius},${textRadius} 0 1,1 0,${textRadius * 2} a ${textRadius},${textRadius} 0 1,1 0,-${textRadius * 2}`
            );

            const circularText = document.getElementById('circular-text');
            circularText.setAttribute('transform', `rotate(-180 ${centerX} ${centerY})`);

            const stamp = document.getElementById('stamp');
            stamp.style.width = `${diameter}px`;
            stamp.style.height = `${diameter}px`;

            const innerRing = document.getElementById('inner-ring');
            innerRing.style.width = `${innerDiameter}px`;
            innerRing.style.height = `${innerDiameter}px`;
            innerRing.classList.add('rounded-full');

            const dashedBorder = document.getElementById('dashed-border');
            dashedBorder.setAttribute('cx', centerX);
            dashedBorder.setAttribute('cy', centerY);
            dashedBorder.setAttribute('r', dashedRadius - 1.5);

            const outerBorder = document.getElementById('outer-border');
            outerBorder.setAttribute('cx', centerX);
            outerBorder.setAttribute('cy', centerY);
            outerBorder.setAttribute('r', radius - 3);

            const fixedStar = document.getElementById('fixed-star');
            fixedStar.setAttribute('x', centerX);
            fixedStar.setAttribute('y', centerY + textRadius);
            fixedStar.setAttribute('transform', 'rotate(0)');
        }

        window.onload = adjustRingSize;
    </script>
</body>

</html>
