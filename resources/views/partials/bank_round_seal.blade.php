<svg viewBox="0 0 300 300" class="stamp">
    <style>
        .rotate-group {
            transform: rotate(10deg);
            transform-origin: 150px 150px;
            opacity: 0.8;
            filter: blur(0.3px);
            contrast(0.9);
        }

        text {
            font-family: Arial, sans-serif;
            font-weight: bold;
            fill: #12008F;
        }

        .circle {
            fill: none;
            stroke: #12008F;
            stroke-width: 4;
        }

        .center-text {
            text-anchor: middle;
            font-size: 16px;
            color: #12008F;
        }

        .curved-text {
            font-size: 20px;
            letter-spacing: 3px;
        }

        .star {
            font-size: 20px;
        }
    </style>

    <g class="rotate-group">
        <circle class="circle" cx="150" cy="150" r="110" />
        <circle class="circle" cx="150" cy="150" r="75" />

        <path id="topTextPath" d="M 65,150 A 80,80 0 0 1 235,150" fill="none" />
        <text class="curved-text">
            <textPath href="#topTextPath" startOffset="50%" text-anchor="middle">
                CITY BANK PLC
            </textPath>
        </text>

        <path id="bottomTextPath" d="M 51,150 A 97,97 0 0 0 247,150" fill="none" />
        <text class="curved-text">
            <textPath href="#bottomTextPath" startOffset="50%" text-anchor="middle">
                {{$bank_short_address}}
            </textPath>
        </text>

        <text x="60" y="155" class="star" text-anchor="middle">&#9733;</text>
        <text x="240" y="155" class="star" text-anchor="middle">&#9733;</text>

        <text x="150" y="145" class="center-text text-uppercase">{{str_replace('Branch', '', $branch_name)}}</text>
        <text x="150" y="165" class="center-text">BRANCH</text>
    </g>
</svg>
