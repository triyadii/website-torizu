<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orvante — Brand Strategy & Pure Design</title>
  <meta name="description" content="Orvante is an editorial branding agency built on pure design, strategic clarity, and performance-driven marketing for growing global brands.">

  <!-- Google Fonts: Inter Tight & Archivo (Variable Width/Weight) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wdth,wght@62..125,100..900&family=Inter+Tight:wght@100..900&display=swap" rel="stylesheet">

  <style>
    /* -------------------------------------------------------------
       CSS Custom Properties & Design Tokens
       ------------------------------------------------------------- */
    :root {
      --u: min(calc(100vw / 1440), 1.333333px);
      --hero-paper: #dadada;
      --ink: #111111;
      --lower-black: #000000;
      --text-white: #f4f4f4;
      --statement-grey: #6f6f6f;
      --hairline-14: rgba(255, 255, 255, 0.14);
      --hairline-20: rgba(255, 255, 255, 0.20);
      --hairline-28: rgba(255, 255, 255, 0.28);
      --font-body: 'Inter Tight', -apple-system, BlinkMacSystemFont, sans-serif;
      --font-display: 'Archivo', sans-serif;
    }

    @media (max-width: 760px) {
      :root {
        --u: calc(100vw / 390);
      }
    }

    /* Reset & Base */
    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html {
      background-color: var(--lower-black);
      color: var(--text-white);
      font-family: var(--font-body);
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      text-rendering: optimizeLegibility;
      overflow-x: hidden;
    }

    body {
      background-color: var(--lower-black);
      overflow-x: hidden;
      width: 100%;
      min-height: 100vh;
      position: relative;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    button {
      background: none;
      border: none;
      cursor: pointer;
      font: inherit;
    }

    img {
      display: block;
      max-width: 100%;
    }

    /* -------------------------------------------------------------
       Section 1: Hero Section (1440 x 938u on Desktop)
       ------------------------------------------------------------- */
    .hero-section {
      width: 100%;
      background-color: var(--hero-paper);
      color: var(--ink);
      position: relative;
      overflow: hidden;
    }

    @media (min-width: 761px) {
      .hero-section {
        height: calc(938 * var(--u));
      }
      .hero-canvas {
        position: relative;
        width: calc(1440 * var(--u));
        height: calc(938 * var(--u));
        margin: 0 auto;
      }
    }

    /* Hero Background Photo */
    .hero-photo-wrap {
      position: absolute;
      left: calc(338 * var(--u));
      top: calc(-86 * var(--u));
      width: calc(764 * var(--u));
      height: calc(1024 * var(--u));
      z-index: 1;
      pointer-events: none;
      overflow: hidden;
      -webkit-mask-image: linear-gradient(to right, transparent 0%, black 6%, black 94%, transparent 100%);
      mask-image: linear-gradient(to right, transparent 0%, black 6%, black 94%, transparent 100%);
    }

    .hero-photo {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transform-origin: center center;
      will-change: transform, filter, opacity;
    }

    /* Navigation Bar */
    .hero-nav {
      position: absolute;
      left: calc(57 * var(--u));
      top: calc(61 * var(--u));
      z-index: 25;
    }

    .nav-pill {
      height: calc(48 * var(--u));
      background: #ffffff;
      border-radius: calc(24 * var(--u));
      display: inline-flex;
      align-items: center;
      padding: calc(4 * var(--u));
      position: relative;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    }

    .nav-slider {
      position: absolute;
      top: calc(4 * var(--u));
      bottom: calc(4 * var(--u));
      left: calc(4 * var(--u));
      background: var(--ink);
      border-radius: calc(20 * var(--u));
      transition: transform 0.32s cubic-bezier(0.2, 0, 0, 1), width 0.32s cubic-bezier(0.2, 0, 0, 1);
      z-index: 1;
      pointer-events: none;
    }

    .nav-item {
      position: relative;
      z-index: 2;
      padding: 0 calc(20 * var(--u));
      height: calc(40 * var(--u));
      line-height: calc(40 * var(--u));
      font-size: calc(14 * var(--u));
      font-weight: 500;
      color: var(--ink);
      transition: color 0.25s ease;
      cursor: pointer;
      user-select: none;
    }

    .nav-item.active {
      color: var(--text-white);
    }

    .nav-item:hover {
      color: var(--text-white);
    }

    /* Top Right Elements */
    .hero-date {
      position: absolute;
      left: calc(1038 * var(--u));
      top: calc(70 * var(--u));
      font-size: calc(13.5 * var(--u));
      font-weight: 500;
      color: var(--ink);
      letter-spacing: -0.01em;
      white-space: nowrap;
      z-index: 10;
    }

    .contact-btn {
      position: absolute;
      left: calc(1237 * var(--u));
      top: calc(63 * var(--u));
      width: calc(144 * var(--u));
      height: calc(46 * var(--u));
      background-color: var(--ink);
      color: var(--text-white);
      border-radius: calc(23 * var(--u));
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: calc(6 * var(--u));
      font-size: calc(14 * var(--u));
      font-weight: 500;
      z-index: 10;
      transition: transform 0.2s ease, background-color 0.2s ease, box-shadow 0.2s ease;
    }

    .contact-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.18);
    }

    /* Title: PURE DESIGN ('25) */
    .hero-title-group {
      position: absolute;
      left: calc(57 * var(--u));
      top: calc(246 * var(--u));
      z-index: 10;
    }

    .title-line-mask {
      overflow: hidden;
      display: block;
    }

    .title-line {
      font-family: var(--font-display);
      font-variation-settings: 'wdth' 104, 'wght' 640;
      font-size: calc(90 * var(--u));
      line-height: 0.86;
      letter-spacing: -0.06em;
      color: var(--ink);
      display: block;
      text-transform: uppercase;
    }

    .hero-year-tag {
      position: absolute;
      left: calc(339 * var(--u));
      top: calc(272 * var(--u));
      font-family: var(--font-body);
      font-size: calc(18 * var(--u));
      font-weight: 500;
      color: var(--ink);
      letter-spacing: -0.02em;
      z-index: 10;
    }

    /* About & Call to Action */
    .hero-about {
      position: absolute;
      left: calc(57 * var(--u));
      top: calc(458 * var(--u));
      width: calc(300 * var(--u));
      z-index: 10;
    }

    .about-label {
      font-size: calc(13 * var(--u));
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.04em;
      color: var(--ink);
      display: flex;
      align-items: center;
      gap: calc(6 * var(--u));
      margin-bottom: calc(10 * var(--u));
    }

    .about-label .dot {
      display: inline-block;
      width: calc(6 * var(--u));
      height: calc(6 * var(--u));
      border-radius: 50%;
      background-color: var(--ink);
    }

    .about-desc {
      font-size: calc(14 * var(--u));
      font-weight: 500;
      line-height: 1.45;
      color: #2b2b2b;
      margin-bottom: calc(24 * var(--u));
    }

    .book-call-btn {
      position: absolute;
      left: calc(57 * var(--u));
      top: calc(584 * var(--u));
      height: calc(46 * var(--u));
      padding: 0 calc(24 * var(--u));
      background-color: var(--ink);
      color: var(--text-white);
      border-radius: calc(23 * var(--u));
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: calc(8 * var(--u));
      font-size: calc(14 * var(--u));
      font-weight: 500;
      z-index: 10;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .book-call-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* Stats Frame (57, 693), 341 x 208u */
    .stats-frame {
      position: absolute;
      left: calc(57 * var(--u));
      top: calc(693 * var(--u));
      width: calc(341 * var(--u));
      height: calc(208 * var(--u));
      background-color: #cdcdcd;
      border-radius: calc(12 * var(--u));
      padding: calc(6 * var(--u));
      display: flex;
      gap: calc(6 * var(--u));
      z-index: 10;
    }

    /* Dark card within stats frame */
    .stat-card-dark {
      flex: 1.05;
      background-color: #151515;
      color: var(--text-white);
      border-radius: calc(8 * var(--u));
      padding: calc(12 * var(--u));
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .dark-card-top .counter-val {
      font-family: var(--font-display);
      font-variation-settings: 'wdth' 100, 'wght' 700;
      font-size: calc(26 * var(--u));
      line-height: 1;
      color: var(--text-white);
    }

    .dark-card-top .counter-lbl {
      font-size: calc(11 * var(--u));
      color: #8c8c8c;
      margin-top: calc(3 * var(--u));
      font-weight: 500;
    }

    .partner-marks-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: calc(4 * var(--u));
      margin: calc(8 * var(--u)) 0;
    }

    .partner-item {
      display: flex;
      align-items: center;
      gap: calc(3 * var(--u));
      font-size: calc(8.5 * var(--u));
      color: #b0b0b0;
      letter-spacing: -0.01em;
    }

    .partner-item svg {
      width: calc(9 * var(--u));
      height: calc(9 * var(--u));
      fill: none;
      stroke: #8c8c8c;
      stroke-width: 1.5;
    }

    .card-book-bar {
      background: #ffffff;
      color: var(--ink);
      height: calc(28 * var(--u));
      border-radius: calc(14 * var(--u));
      display: flex;
      align-items: center;
      justify-content: center;
      gap: calc(4 * var(--u));
      font-size: calc(10.5 * var(--u));
      font-weight: 600;
      transition: background 0.2s ease;
    }

    .card-book-bar:hover {
      background: #f0f0f0;
    }

    /* Photo card within stats frame */
    .stat-card-photo {
      flex: 0.95;
      position: relative;
      border-radius: calc(8 * var(--u));
      overflow: hidden;
      background-color: #111;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: calc(10 * var(--u));
    }

    .stat-card-photo .bg-img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0.62;
      z-index: 1;
    }

    .stat-card-photo .overlay-top {
      position: relative;
      z-index: 2;
      font-size: calc(10 * var(--u));
      color: #e0e0e0;
      font-weight: 500;
      padding-bottom: calc(5 * var(--u));
      border-bottom: 1px solid rgba(255, 255, 255, 0.22);
    }

    .stat-card-photo .overlay-bottom {
      position: relative;
      z-index: 2;
      text-align: right;
    }

    .overlay-bottom .counter-val {
      font-family: var(--font-display);
      font-variation-settings: 'wdth' 100, 'wght' 700;
      font-size: calc(22 * var(--u));
      line-height: 1;
      color: var(--text-white);
    }

    .overlay-bottom .counter-lbl {
      font-size: calc(9 * var(--u));
      line-height: 1.25;
      color: #cccccc;
      margin-top: calc(3 * var(--u));
      font-weight: 400;
    }

    /* Right Column: True Growth Pill (1216, 258) */
    .true-growth-pill {
      position: absolute;
      left: calc(1216 * var(--u));
      top: calc(258 * var(--u));
      background: rgba(255, 255, 255, 0.72);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(0, 0, 0, 0.08);
      border-radius: calc(20 * var(--u));
      padding: calc(5 * var(--u)) calc(14 * var(--u)) calc(5 * var(--u)) calc(6 * var(--u));
      display: inline-flex;
      align-items: center;
      gap: calc(8 * var(--u));
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
      z-index: 10;
    }

    .check-disc {
      width: calc(22 * var(--u));
      height: calc(22 * var(--u));
      border-radius: 50%;
      background: var(--ink);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .check-disc svg {
      width: calc(11 * var(--u));
      height: calc(11 * var(--u));
      stroke: #ffffff;
      stroke-width: 2.5;
      fill: none;
    }

    .true-growth-text {
      font-size: calc(13 * var(--u));
      font-weight: 600;
      color: var(--ink);
      white-space: nowrap;
    }

    /* Available indicator (y 442) */
    .available-tag {
      position: absolute;
      left: calc(1216 * var(--u));
      top: calc(442 * var(--u));
      width: calc(165 * var(--u));
      text-align: right;
      z-index: 10;
    }

    .available-tag .line-1 {
      font-size: calc(14.5 * var(--u));
      font-weight: 500;
      color: var(--ink);
      line-height: 1.3;
    }

    .available-tag .line-2 {
      font-size: calc(14.5 * var(--u));
      font-weight: 500;
      color: var(--ink);
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: calc(6 * var(--u));
    }

    .available-dot {
      display: inline-block;
      width: calc(7 * var(--u));
      height: calc(7 * var(--u));
      border-radius: 50%;
      background-color: #10b981;
    }

    /* Out Now / Q Industrial Card (196u tall) */
    .q-industrial-card {
      position: absolute;
      left: calc(1160 * var(--u));
      top: calc(500 * var(--u));
      width: calc(221 * var(--u));
      height: calc(196 * var(--u));
      border-radius: calc(10 * var(--u));
      overflow: hidden;
      z-index: 10;
      cursor: pointer;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    }

    .q-img-wrap {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
    }

    .q-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transform: scale(1.55);
      transform-origin: 62% 45%;
      transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .q-industrial-card:hover .q-img {
      transform: scale(1.68);
    }

    .q-card-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, rgba(0, 0, 0, 0.65) 0%, rgba(0, 0, 0, 0.1) 40%, rgba(0, 0, 0, 0.75) 100%);
      padding: calc(12 * var(--u));
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      z-index: 2;
    }

    .q-card-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
    }

    .q-badge-text {
      font-size: calc(10 * var(--u));
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: rgba(255, 255, 255, 0.85);
      font-weight: 600;
    }

    .q-title {
      font-family: var(--font-display);
      font-variation-settings: 'wdth' 100, 'wght' 600;
      font-size: calc(15 * var(--u));
      color: #ffffff;
      margin-top: calc(2 * var(--u));
      line-height: 1.1;
    }

    .q-year {
      font-size: calc(10.5 * var(--u));
      color: rgba(255, 255, 255, 0.65);
      font-weight: 400;
    }

    .q-arrow-btn {
      width: calc(34 * var(--u));
      height: calc(34 * var(--u));
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.28);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.4);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), background 0.3s;
    }

    .q-arrow-btn svg {
      width: calc(13 * var(--u));
      height: calc(13 * var(--u));
      stroke: #ffffff;
      stroke-width: 2;
      fill: none;
      transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .q-industrial-card:hover .q-arrow-btn {
      background: rgba(255, 255, 255, 0.45);
    }

    .q-industrial-card:hover .q-arrow-btn svg {
      transform: rotate(45deg);
    }

    .q-progress-bar {
      width: 100%;
      height: calc(2 * var(--u));
      background: rgba(255, 255, 255, 0.35);
      border-radius: calc(1 * var(--u));
      overflow: hidden;
      margin-top: calc(8 * var(--u));
    }

    .q-progress-fill {
      height: 100%;
      width: 0%;
      background: #ffffff;
      border-radius: calc(1 * var(--u));
      transition: width 1.2s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* Brand plate at (532, 444), 364 x 73u */
    .brand-plate {
      position: absolute;
      left: calc(532 * var(--u));
      top: calc(444 * var(--u));
      width: calc(364 * var(--u));
      height: calc(73 * var(--u));
      background: rgba(18, 18, 18, 0.82);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.16);
      border-radius: calc(12 * var(--u));
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 calc(24 * var(--u));
      box-shadow: 0 20px 45px rgba(0, 0, 0, 0.28);
      z-index: 15;
    }

    .brand-mark {
      width: calc(26 * var(--u));
      height: calc(26 * var(--u));
    }

    .brand-title {
      font-family: var(--font-display);
      font-variation-settings: 'wdth' 125, 'wght' 700;
      font-size: calc(25 * var(--u));
      letter-spacing: 0.12em;
      color: #ffffff;
      text-transform: uppercase;
    }

    .brand-menu-icon {
      width: calc(22 * var(--u));
      display: flex;
      flex-direction: column;
      gap: calc(5 * var(--u));
    }

    .brand-menu-icon span {
      display: block;
      height: calc(1.8 * var(--u));
      background: #ffffff;
      border-radius: 1px;
    }

    /* Logos at y 864 across jacket */
    .hero-logos {
      position: absolute;
      top: calc(864 * var(--u));
      left: 0;
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: calc(24 * var(--u));
      font-family: var(--font-display);
      font-variation-settings: 'wdth' 110, 'wght' 500;
      font-size: calc(14 * var(--u));
      letter-spacing: 0.18em;
      color: #ffffff;
      opacity: 0.88;
      text-transform: uppercase;
      z-index: 10;
      pointer-events: none;
    }

    .hero-logos span {
      color: rgba(255, 255, 255, 0.4);
    }

    /* -------------------------------------------------------------
       Section 2: Black Bar & Statement Section
       ------------------------------------------------------------- */
    .bar-section {
      width: 100%;
      height: calc(111 * var(--u));
      background: var(--lower-black);
      border-bottom: 1px solid var(--hairline-14);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 calc(57 * var(--u));
      font-family: var(--font-display);
      font-variation-settings: 'wdth' 115, 'wght' 600;
      font-size: calc(14 * var(--u));
      letter-spacing: 0.08em;
      text-transform: uppercase;
      position: relative;
      z-index: 20;
    }

    .bar-left {
      color: #ffffff;
    }

    .bar-left .grey-year {
      color: var(--statement-grey);
    }

    .bar-mid {
      display: flex;
      align-items: center;
      gap: calc(10 * var(--u));
      color: #ffffff;
    }

    .bar-arrow-circle {
      width: calc(30 * var(--u));
      height: calc(30 * var(--u));
      border-radius: 50%;
      background: #ffffff;
      color: #000000;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .bar-arrow-circle svg {
      width: calc(12 * var(--u));
      height: calc(12 * var(--u));
      stroke: #000000;
      stroke-width: 2.2;
      fill: none;
    }

    .bar-right {
      color: var(--statement-grey);
    }

    /* Statement Section */
    .statement-section {
      width: 100%;
      background: var(--lower-black);
      padding-top: calc(170 * var(--u));
      padding-bottom: calc(230 * var(--u));
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      position: relative;
    }

    .statement-container {
      width: 100%;
      max-width: calc(830 * var(--u));
      margin: 0 auto;
      padding: 0 calc(20 * var(--u));
    }

    .statement-text {
      font-family: var(--font-body);
      font-size: calc(52 * var(--u));
      line-height: 1.33;
      letter-spacing: -0.028em;
      font-weight: 500;
      color: var(--statement-grey);
    }

    .statement-line {
      display: block;
      white-space: nowrap;
    }

    .statement-word {
      display: inline-block;
      color: var(--statement-grey);
      transition: color 0.15s ease-out;
      will-change: color;
    }

    .statement-subline {
      margin-top: calc(150 * var(--u));
      font-family: var(--font-body);
      font-size: calc(23 * var(--u));
      line-height: 1.45;
      color: var(--text-white);
      font-weight: 400;
      max-width: calc(720 * var(--u));
      text-wrap: balance;
    }

    .statement-subline em {
      font-style: italic;
      color: var(--statement-grey);
    }

    /* -------------------------------------------------------------
       Section 3: Trust Panel Section
       ------------------------------------------------------------- */
    .trust-section {
      width: 100%;
      background: var(--lower-black);
      padding-bottom: calc(150 * var(--u));
      display: flex;
      justify-content: center;
      position: relative;
    }

    .trust-panel {
      width: calc(1302 * var(--u));
      height: calc(429 * var(--u));
      border: 1px solid var(--hairline-28);
      border-radius: calc(14 * var(--u));
      position: relative;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 calc(48 * var(--u));
      background: radial-gradient(circle at 15% 50%, rgba(25, 25, 25, 0.35) 0%, rgba(0, 0, 0, 0.8) 100%);
      overflow: hidden;
    }

    /* Left Heading & Copy */
    .trust-left {
      width: calc(480 * var(--u));
      position: relative;
      z-index: 5;
    }

    .trust-heading {
      font-family: var(--font-body);
      font-size: calc(55 * var(--u));
      font-weight: 500;
      line-height: 1.05;
      letter-spacing: -0.03em;
      color: var(--text-white);
      position: relative;
    }

    .trust-desc {
      font-size: calc(14.5 * var(--u));
      line-height: 1.5;
      color: rgba(244, 244, 244, 0.65);
      margin-top: calc(28 * var(--u));
      max-width: calc(410 * var(--u));
    }

    /* Two Frosted Glass Icon Tiles (88u, 12u radius) */
    .glass-tile {
      width: calc(88 * var(--u));
      height: calc(88 * var(--u));
      border-radius: calc(12 * var(--u));
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      border: 1px solid rgba(255, 255, 255, 0.22);
      box-shadow: 0 10px 32px rgba(0, 0, 0, 0.45);
      position: absolute;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 10;
      pointer-events: none;
    }

    .glass-tile-asterisk {
      top: calc(-14 * var(--u));
      left: calc(285 * var(--u));
    }

    .glass-tile-asterisk svg {
      width: calc(38 * var(--u));
      height: calc(38 * var(--u));
      stroke: #ffffff;
      stroke-width: 1.8;
      fill: none;
    }

    .glass-tile-dots {
      top: calc(150 * var(--u));
      left: calc(300 * var(--u));
    }

    .glass-tile-dots .dots-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: calc(10 * var(--u));
    }

    .dots-grid span {
      display: block;
      width: calc(8 * var(--u));
      height: calc(8 * var(--u));
      background: #ffffff;
      border-radius: 50%;
    }

    /* Right Cards Group (326u tall) */
    .trust-cards-group {
      display: flex;
      align-items: center;
      gap: calc(16 * var(--u));
      height: calc(326 * var(--u));
      position: relative;
      z-index: 5;
    }

    /* Trust Card Base */
    .trust-card {
      height: calc(326 * var(--u));
      border-radius: calc(8 * var(--u));
      transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.35s ease;
      cursor: default;
      will-change: transform;
    }

    .trust-card:hover {
      transform: translateY(calc(-6 * var(--u)));
      box-shadow: 0 16px 36px rgba(0, 0, 0, 0.35);
    }

    /* Avatar Card (light grey #d6d6d6, 293u) */
    .avatar-card {
      width: calc(293 * var(--u));
      background-color: #d6d6d6;
      color: var(--ink);
      padding: calc(22 * var(--u));
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .avatar-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: calc(8 * var(--u));
    }

    .avatar-item {
      width: calc(48 * var(--u));
      height: calc(48 * var(--u));
      border-radius: 50%;
      overflow: hidden;
      border: 2px solid #ffffff;
      background: #c0c0c0;
      transform: scale(0.4);
      opacity: 0;
      transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.4s ease;
    }

    .avatar-item.popped {
      transform: scale(1);
      opacity: 1;
    }

    .avatar-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .avatar-stats .counter-big {
      font-family: var(--font-display);
      font-variation-settings: 'wdth' 100, 'wght' 700;
      font-size: calc(43 * var(--u));
      line-height: 1;
      color: var(--ink);
      letter-spacing: -0.03em;
    }

    .avatar-stats .counter-label {
      font-size: calc(14 * var(--u));
      font-weight: 500;
      color: #4b4b4b;
      margin-top: calc(4 * var(--u));
    }

    /* Awards Card (#262626, 298u) */
    .awards-card {
      width: calc(298 * var(--u));
      background-color: #262626;
      color: var(--text-white);
      padding: calc(22 * var(--u));
      border: 1px solid rgba(255, 255, 255, 0.08);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .awards-top .counter-big {
      font-family: var(--font-display);
      font-variation-settings: 'wdth' 100, 'wght' 700;
      font-size: calc(43 * var(--u));
      line-height: 1;
      color: var(--text-white);
      letter-spacing: -0.03em;
    }

    .awards-top .counter-label {
      font-size: calc(14 * var(--u));
      font-weight: 500;
      color: #999999;
      margin-top: calc(4 * var(--u));
    }

    /* Laurel Badge */
    .laurel-badge-wrap {
      display: flex;
      align-items: center;
      justify-content: center;
      margin: calc(10 * var(--u)) 0;
    }

    .laurel-svg-container {
      width: calc(170 * var(--u));
      height: calc(76 * var(--u));
    }

    .awards-bottom-note {
      font-size: calc(12 * var(--u));
      line-height: 1.4;
      color: #888888;
      font-weight: 400;
    }

    /* Portrait Card (200u, cut off by right edge) */
    .portrait-card {
      width: calc(200 * var(--u));
      position: relative;
      overflow: hidden;
      background: #191919;
    }

    .portrait-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* -------------------------------------------------------------
       Motion & Load Animations
       ------------------------------------------------------------- */
    .anim-fade-up {
      opacity: 0;
      transform: translateY(14px);
      transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .anim-fade-up.is-visible {
      opacity: 1;
      transform: translateY(0);
    }

    .hero-photo {
      opacity: 0;
      filter: blur(14px);
      transform: translateY(40px);
      transition: opacity 1.3s cubic-bezier(0.16, 1, 0.3, 1), filter 1.3s cubic-bezier(0.16, 1, 0.3, 1), transform 1.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .hero-photo.is-visible {
      opacity: 1;
      filter: blur(0px);
      transform: translateY(0);
    }

    .hero-nav {
      opacity: 0;
      transform: translateY(-24px);
      transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1), transform 0.9s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .hero-nav.is-visible {
      opacity: 1;
      transform: translateY(0);
    }

    .title-line {
      transform: translateY(110%);
      transition: transform 1s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .title-line.is-visible {
      transform: translateY(0);
    }

    /* -------------------------------------------------------------
       Phone (<= 760px) Responsive Layout
       ------------------------------------------------------------- */
    @media (max-width: 760px) {
      .hero-section {
        height: auto;
        padding-bottom: calc(40 * var(--u));
      }

      .hero-canvas {
        position: relative;
        width: 100%;
        height: auto;
        padding: calc(20 * var(--u));
        display: flex;
        flex-direction: column;
      }

      /* 1. Header row: Nav on left, 40u square contact arrow on right */
      .phone-top-bar {
        order: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        margin-bottom: calc(28 * var(--u));
        position: relative;
        z-index: 30;
      }

      .hero-nav {
        position: static;
        opacity: 1;
        transform: none;
      }

      .nav-pill {
        height: calc(44 * var(--u));
        padding: calc(3 * var(--u));
      }

      .nav-item {
        padding: 0 calc(12 * var(--u));
        font-size: calc(13 * var(--u));
        height: calc(38 * var(--u));
        line-height: calc(38 * var(--u));
      }

      .hero-date {
        display: none;
      }

      .contact-btn {
        position: static;
        width: calc(40 * var(--u));
        height: calc(40 * var(--u));
        border-radius: calc(10 * var(--u));
        padding: 0;
        gap: 0;
      }

      .contact-btn span.btn-label {
        display: none;
      }

      /* 2. Title & Year */
      .hero-title-group {
        order: 2;
        position: static;
        margin-bottom: calc(16 * var(--u));
      }

      .title-line {
        font-size: calc(56 * var(--u));
        line-height: 0.92;
      }

      .hero-year-tag {
        order: 2;
        position: static;
        display: inline-block;
        margin-top: calc(4 * var(--u));
        margin-bottom: calc(16 * var(--u));
        font-size: calc(16 * var(--u));
      }

      /* 3. (ABOUT) Copy & Book A Call */
      .hero-about {
        order: 3;
        position: static;
        width: 100%;
        margin-bottom: calc(16 * var(--u));
      }

      .about-desc {
        font-size: calc(14.5 * var(--u));
        max-width: 100%;
        margin-bottom: calc(16 * var(--u));
      }

      .book-call-btn {
        order: 3;
        position: static;
        width: fit-content;
        margin-bottom: calc(28 * var(--u));
      }

      /* 4. Full-width photo (470u) with brand plate & logos */
      .hero-photo-wrap {
        order: 4;
        position: relative;
        left: auto;
        top: auto;
        width: 100%;
        height: calc(470 * var(--u));
        border-radius: calc(14 * var(--u));
        overflow: hidden;
        margin-bottom: calc(24 * var(--u));
        -webkit-mask-image: none;
        mask-image: none;
      }

      .hero-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .brand-plate {
        position: absolute;
        left: 5%;
        right: 5%;
        width: 90%;
        top: calc(200 * var(--u));
        height: calc(64 * var(--u));
        padding: 0 calc(16 * var(--u));
        z-index: 20;
      }

      .brand-title {
        font-size: calc(20 * var(--u));
      }

      .hero-logos {
        position: absolute;
        top: auto;
        bottom: calc(20 * var(--u));
        left: 0;
        width: 100%;
        font-size: calc(11 * var(--u));
        gap: calc(14 * var(--u));
        z-index: 20;
      }

      /* 5. True Growth pill */
      .true-growth-pill {
        order: 5;
        position: static;
        width: fit-content;
        margin-bottom: calc(16 * var(--u));
      }

      .available-tag {
        order: 5;
        position: static;
        width: 100%;
        text-align: left;
        margin-bottom: calc(20 * var(--u));
      }

      .available-tag .line-2 {
        justify-content: flex-start;
      }

      /* 6. Stats frame (two columns) */
      .stats-frame {
        order: 6;
        position: static;
        width: 100%;
        height: auto;
        min-height: calc(190 * var(--u));
        margin-bottom: calc(20 * var(--u));
      }

      /* 7. Out Now card */
      .q-industrial-card {
        order: 7;
        position: static;
        width: 100%;
        height: calc(220 * var(--u));
      }

      /* Bar Section on Phone */
      .bar-section {
        height: auto;
        padding: calc(24 * var(--u)) calc(20 * var(--u));
        flex-direction: column;
        gap: calc(16 * var(--u));
        text-align: center;
      }

      /* Statement on Phone */
      .statement-section {
        padding-top: calc(90 * var(--u));
        padding-bottom: calc(120 * var(--u));
      }

      .statement-text {
        font-size: calc(28 * var(--u));
      }

      .statement-line {
        white-space: normal;
      }

      .statement-subline {
        margin-top: calc(60 * var(--u));
        font-size: calc(17 * var(--u));
      }

      /* Trust Panel on Phone */
      .trust-section {
        padding-bottom: calc(80 * var(--u));
        padding-left: calc(16 * var(--u));
        padding-right: calc(16 * var(--u));
      }

      .trust-panel {
        width: 100%;
        height: auto;
        padding: calc(32 * var(--u)) calc(20 * var(--u));
        flex-direction: column;
        gap: calc(36 * var(--u));
      }

      .trust-left {
        width: 100%;
      }

      .trust-heading {
        font-size: calc(38 * var(--u));
      }

      .glass-tile-dots {
        display: none; /* hidden on phone per prompt */
      }

      .glass-tile-asterisk {
        top: calc(-12 * var(--u));
        left: calc(220 * var(--u));
        width: calc(64 * var(--u));
        height: calc(64 * var(--u));
      }

      .glass-tile-asterisk svg {
        width: calc(28 * var(--u));
        height: calc(28 * var(--u));
      }

      .trust-cards-group {
        flex-direction: column;
        width: 100%;
        height: auto;
        gap: calc(20 * var(--u));
      }

      .avatar-card, .awards-card, .portrait-card {
        width: 100%;
        height: auto;
        min-height: calc(260 * var(--u));
      }

      .portrait-card {
        height: calc(220 * var(--u));
      }
    }

    /* -------------------------------------------------------------
       Reduced Motion
       ------------------------------------------------------------- */
    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
      }
      .statement-word {
        color: var(--text-white) !important;
      }
      .avatar-item {
        transform: scale(1) !important;
        opacity: 1 !important;
      }
      .q-progress-fill {
        width: 100% !important;
      }
    }
  </style>
</head>
<body>

  <!-- =============================================================
       SECTION 1: HERO SECTION
       ============================================================= -->
  <section class="hero-section" id="hero">
    <div class="hero-canvas">

      <!-- Navigation & Contact Row (responsive for phone) -->
      <div class="phone-top-bar">
        <nav class="hero-nav anim-load" id="heroNav" aria-label="Main Navigation">
          <div class="nav-pill" id="navPill">
            <div class="nav-slider" id="navSlider"></div>
            <a class="nav-item active" href="#hero" data-nav="0">Home</a>
            <a class="nav-item" href="#statement" data-nav="1">Studio</a>
            <a class="nav-item" href="#trust" data-nav="2">Works</a>
            <a class="nav-item" href="#trust" data-nav="3">Blog</a>
          </div>
        </nav>

        <a href="#contact" class="contact-btn anim-fade-up" id="contactBtn" aria-label="Contact Us">
          <span class="btn-label">Contact Us</span>
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.5 9.5L9.5 2.5M9.5 2.5H4M9.5 2.5V8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>

      <!-- Desktop Date -->
      <div class="hero-date anim-fade-up">Sunday / 17.06 – 27 June 2026</div>

      <!-- Title: PURE DESIGN ('25) -->
      <div class="hero-title-group">
        <div class="title-line-mask">
          <h1 class="title-line" id="titleLine1">PURE</h1>
        </div>
        <div class="title-line-mask">
          <span class="title-line" id="titleLine2">DESIGN</span>
        </div>
      </div>
      <span class="hero-year-tag anim-fade-up">(’25)</span>

      <!-- About Copy & CTA -->
      <div class="hero-about anim-fade-up">
        <div class="about-label">
          <span class="dot"></span> (ABOUT)
        </div>
        <p class="about-desc">
          Building stunning website that every brand deserves to be seen.
        </p>
      </div>

      <a href="#contact" class="book-call-btn anim-fade-up" id="heroBookBtn">
        <span>Book A Call</span>
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M2.5 9.5L9.5 2.5M9.5 2.5H4M9.5 2.5V8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>

      <!-- Background Photo Wrap (contains photo, brand plate & logos) -->
      <div class="hero-photo-wrap" id="heroPhotoWrap">
        <img
          src="https://d2ol7oe51mr4n9.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/7dc8b8f3-4ccb-4599-8ce4-7f7c7881bad9.webp"
          alt="Orvante Studio East Asian model in dark technical jacket"
          class="hero-photo"
          id="heroPhoto"
          loading="eager"
        >
        <!-- Brand Plate over the man's back -->
        <div class="brand-plate anim-fade-up" id="brandPlate">
          <!-- Two-part minimal triangular mark -->
          <svg class="brand-mark" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <polygon points="4,24 14,5 24,24" stroke="#ffffff" stroke-width="2.2" stroke-linejoin="round"/>
            <polygon points="10,24 14,14 18,24" fill="#ffffff"/>
          </svg>
          <span class="brand-title">ORVANTE</span>
          <div class="brand-menu-icon" aria-hidden="true">
            <span></span>
            <span></span>
          </div>
        </div>

        <!-- Fictional Wordmarks across the jacket -->
        <div class="hero-logos anim-fade-up">
          Lumon <span>·</span> Paperfold <span>·</span> Northwind
        </div>
      </div>

      <!-- Stats Frame (57, 693), 341 x 208u -->
      <div class="stats-frame anim-fade-up" id="statsFrame">
        <!-- Dark Card -->
        <div class="stat-card-dark">
          <div class="dark-card-top">
            <div class="counter-val" id="counter400">400+</div>
            <div class="counter-lbl">Trusted Partner</div>
          </div>
          <!-- 6 fictional partner marks -->
          <div class="partner-marks-grid">
            <div class="partner-item">
              <svg viewBox="0 0 12 12"><circle cx="6" cy="6" r="4.5"/></svg>
              <span>Halcyon</span>
            </div>
            <div class="partner-item">
              <svg viewBox="0 0 12 12"><polygon points="6,1.5 10.5,9.5 1.5,9.5"/></svg>
              <span>Ostra</span>
            </div>
            <div class="partner-item">
              <svg viewBox="0 0 12 12"><rect x="2" y="2" width="8" height="8" rx="1.5"/></svg>
              <span>Fenwick</span>
            </div>
            <div class="partner-item">
              <svg viewBox="0 0 12 12"><path d="M2,6 Q6,2 10,6 Q6,10 2,6 Z"/></svg>
              <span>Monolo</span>
            </div>
            <div class="partner-item">
              <svg viewBox="0 0 12 12"><path d="M2,10 L6,2 L10,10 Z"/></svg>
              <span>Kitefly</span>
            </div>
            <div class="partner-item">
              <svg viewBox="0 0 12 12"><circle cx="6" cy="4" r="2.5"/><line x1="6" y1="6.5" x2="6" y2="10.5"/></svg>
              <span>Arbor</span>
            </div>
          </div>
          <a href="#contact" class="card-book-bar">
            <span>Book a call</span>
            <svg width="10" height="10" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M2.5 9.5L9.5 2.5M9.5 2.5H4M9.5 2.5V8"/>
            </svg>
          </a>
        </div>

        <!-- Photo Card -->
        <div class="stat-card-photo">
          <img
            src="https://d2ol7oe51mr4n9.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/a9d3641f-d629-46e5-8d2d-5f75386b803d.webp"
            alt="Young man in black cap"
            class="bg-img"
          >
          <div class="overlay-top">Studio Feed · 05/06</div>
          <div class="overlay-bottom">
            <div class="counter-val" id="counter230">230+</div>
            <div class="counter-lbl">Projects successfully launched worldwide</div>
          </div>
        </div>
      </div>

      <!-- Right Column: True Growth Pill -->
      <div class="true-growth-pill anim-fade-up">
        <div class="check-disc">
          <svg viewBox="0 0 12 12">
            <polyline points="2.5,6.5 5,9 9.5,3.5"/>
          </svg>
        </div>
        <span class="true-growth-text">True Growth</span>
      </div>

      <!-- Right Column: We're available -->
      <div class="available-tag anim-fade-up">
        <div class="line-1">We’re available</div>
        <div class="line-2">
          <span class="available-dot"></span> for you
        </div>
      </div>

      <!-- Right Column: Out Now / Q Industrial Card -->
      <div class="q-industrial-card anim-fade-up" id="qIndustrialCard">
        <div class="q-img-wrap">
          <img
            src="https://d2ol7oe51mr4n9.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/9340eb08-877d-4d08-91fb-b70754541d98.webp"
            alt="Q Industrial abstract fashion"
            class="q-img"
          >
        </div>
        <div class="q-card-overlay">
          <div class="q-card-header">
            <div>
              <div class="q-badge-text">Out Now</div>
              <div class="q-title">Q Industrial</div>
              <div class="q-year">[2025]</div>
            </div>
            <div class="q-arrow-btn">
              <svg viewBox="0 0 12 12">
                <path d="M2.5 9.5L9.5 2.5M9.5 2.5H4M9.5 2.5V8"/>
              </svg>
            </div>
          </div>
          <div class="q-progress-bar">
            <div class="q-progress-fill" id="qProgressFill"></div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- =============================================================
       SECTION 2: BAR & STATEMENT SECTION
       ============================================================= -->
  <!-- 111u Black Bar -->
  <section class="bar-section" aria-label="Editorial Bar">
    <div class="bar-left">
      EST <span class="grey-year">2019</span>
    </div>
    <div class="bar-mid">
      <span>SCROLL DOWN</span>
      <div class="bar-arrow-circle" aria-hidden="true">
        <svg viewBox="0 0 12 12">
          <path d="M6 2.5V9.5M6 9.5L2.5 6M6 9.5L9.5 6"/>
        </svg>
      </div>
    </div>
    <div class="bar-right">
      LIVE IN DETAILS
    </div>
  </section>

  <!-- Statement Section with Scroll-filling Words -->
  <section class="statement-section" id="statement" aria-label="Agency Manifesto">
    <div class="statement-container">
      <p class="statement-text" id="statementText">
        <!-- Rendered with spans in exact 5 lines -->
      </p>

      <div class="statement-subline">
        Performance-driven marketing, from strategy to execution. <em>Built for growing brands.</em>
      </div>
    </div>
  </section>

  <!-- =============================================================
       SECTION 3: TRUST PANEL SECTION
       ============================================================= -->
  <section class="trust-section" id="trust" aria-label="Trusted by Clients">
    <div class="trust-panel" id="trustPanel">

      <!-- Left Content -->
      <div class="trust-left">
        <!-- Overlapping Glass Tile 1: Asterisk -->
        <div class="glass-tile glass-tile-asterisk" aria-hidden="true">
          <svg viewBox="0 0 24 24">
            <path d="M12 2V22M2 12H22M4.93 4.93L19.07 19.07M4.93 19.07L19.07 4.93"/>
          </svg>
        </div>

        <h2 class="trust-heading">
          Trusted by<br>
          Hundreds of<br>
          Growing<br>
          Businesses
        </h2>

        <!-- Overlapping Glass Tile 2: Four Dots -->
        <div class="glass-tile glass-tile-dots" aria-hidden="true">
          <div class="dots-grid">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>

        <p class="trust-desc">
          Empowering ambitious brands with visionary design systems, strategic clarity, and high-impact digital experiences that scale globally.
        </p>
      </div>

      <!-- Right Stat Cards -->
      <div class="trust-cards-group">

        <!-- Card 1: Avatar Card (light grey #d6d6d6, 293u) -->
        <div class="trust-card avatar-card">
          <div class="avatar-grid" id="avatarGrid">
            <div class="avatar-item"><img src="https://d2ol7oe51mr4n9.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/300f41b1-3de5-4153-afde-06e15e753ad0.webp" alt="Client 1"></div>
            <div class="avatar-item"><img src="https://d2ol7oe51mr4n9.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/bfff4cdf-4fda-4491-ada6-62f3b6236492.webp" alt="Client 2"></div>
            <div class="avatar-item"><img src="https://d2ol7oe51mr4n9.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/943b121e-fe72-479f-93ae-aa8cd1650f69.webp" alt="Client 3"></div>
            <div class="avatar-item"><img src="https://d2ol7oe51mr4n9.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/c673306f-2b81-4c3d-a7d2-3df61d481abb.webp" alt="Client 4"></div>
            <div class="avatar-item"><img src="https://d2ol7oe51mr4n9.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/2e4fcf11-d0fc-4f31-8f7a-dfe751777141.webp" alt="Client 5"></div>
            <div class="avatar-item"><img src="https://d2ol7oe51mr4n9.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/ab458fcd-4c2c-426f-8213-21cc3c7274be.webp" alt="Client 6"></div>
            <div class="avatar-item"><img src="https://d2ol7oe51mr4n9.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/c1fcd833-5ac9-41e9-9352-fead7e64fa24.webp" alt="Client 7"></div>
            <div class="avatar-item"><img src="https://d2ol7oe51mr4n9.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/4c2b3307-e555-4633-949c-efd3b7e09d82.webp" alt="Client 8"></div>
          </div>
          <div class="avatar-stats">
            <div class="counter-big" id="counter56M">56M+</div>
            <div class="counter-label">Global Collaborations</div>
          </div>
        </div>

        <!-- Card 2: Awards Card (#262626, 298u) -->
        <div class="trust-card awards-card" id="awardsCard">
          <div class="awards-top">
            <div class="counter-big" id="counter10">10+</div>
            <div class="counter-label">Industry Awards</div>
          </div>

          <!-- SVG Laurel Badge "BEST GROWTH PARTNER 2026" -->
          <div class="laurel-badge-wrap">
            <svg class="laurel-svg-container" viewBox="0 0 170 76" fill="none" xmlns="http://www.w3.org/2000/svg" aria-label="Best Growth Partner 2026 Laurel Badge">
              <!-- Left Laurel Wreath -->
              <path d="M42 66 C32 60 22 48 20 36 C18 24 24 14 36 8" stroke="#888888" stroke-width="1.4" stroke-linecap="round"/>
              <path d="M26 58 C20 54 18 48 22 46 C26 44 28 50 26 58 Z" fill="#777777"/>
              <path d="M21 46 C15 42 15 35 19 33 C23 32 24 38 21 46 Z" fill="#777777"/>
              <path d="M20 33 C15 28 17 21 21 20 C25 19 25 26 20 33 Z" fill="#777777"/>
              <path d="M24 21 C21 15 26 10 29 10 C33 10 31 16 24 21 Z" fill="#777777"/>
              <path d="M32 12 C30 8 36 5 39 6 C42 8 39 12 32 12 Z" fill="#777777"/>

              <!-- Right Laurel Wreath -->
              <path d="M128 66 C138 60 148 48 150 36 C152 24 146 14 134 8" stroke="#888888" stroke-width="1.4" stroke-linecap="round"/>
              <path d="M144 58 C150 54 152 48 148 46 C144 44 142 50 144 58 Z" fill="#777777"/>
              <path d="M149 46 C155 42 155 35 151 33 C147 32 146 38 149 46 Z" fill="#777777"/>
              <path d="M150 33 C155 28 153 21 149 20 C145 19 145 26 150 33 Z" fill="#777777"/>
              <path d="M146 21 C149 15 144 10 141 10 C137 10 139 16 146 21 Z" fill="#777777"/>
              <path d="M138 12 C140 8 134 5 131 6 C128 8 131 12 138 12 Z" fill="#777777"/>

              <!-- Badge Typography -->
              <text x="85" y="24" text-anchor="middle" fill="#d4d4d4" font-family="'Archivo', sans-serif" font-weight="700" font-size="7.5" letter-spacing="0.14em">BEST GROWTH</text>
              <text x="85" y="38" text-anchor="middle" fill="#ffffff" font-family="'Archivo', sans-serif" font-weight="800" font-size="10.5" letter-spacing="0.16em">PARTNER</text>
              <text x="85" y="52" text-anchor="middle" fill="#888888" font-family="'Inter Tight', sans-serif" font-weight="600" font-size="8" letter-spacing="0.22em">2026</text>
              <circle cx="85" cy="60" r="1.5" fill="#666666"/>
            </svg>
          </div>

          <p class="awards-bottom-note">
            Recognized internationally for transformative design and brand excellence.
          </p>
        </div>

        <!-- Card 3: Portrait Card (200u, cut off by panel's right edge) -->
        <div class="trust-card portrait-card">
          <img
            src="https://d2ol7oe51mr4n9.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/addecc7d-666f-4342-8290-ed7f7cbbffd6.webp"
            alt="Side profile in white t-shirt on blue-grey gradient"
          >
        </div>

      </div>
    </div>
  </section>

  <!-- =============================================================
       VANILLA JAVASCRIPT: MOTION & INTERACTION ENGINE
       ============================================================= -->
  <script>
    (function() {
      'use strict';

      // Check URL parameters for recorder mode (?rec=1) and prefers-reduced-motion
      const urlParams = new URLSearchParams(window.location.search);
      const isRecorder = urlParams.get('rec') === '1';
      const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

      /* -----------------------------------------------------------
         1. Interactive Sliding Nav Pill
         ----------------------------------------------------------- */
      const navPill = document.getElementById('navPill');
      const navSlider = document.getElementById('navSlider');
      const navItems = document.querySelectorAll('.nav-item');
      let activeItem = document.querySelector('.nav-item.active') || navItems[0];

      function updateSlider(target) {
        if (!target || !navSlider || !navPill) return;
        const targetRect = target.getBoundingClientRect();
        const pillRect = navPill.getBoundingClientRect();
        const left = targetRect.left - pillRect.left;
        const width = targetRect.width;

        navSlider.style.transform = `translateX(${left}px)`;
        navSlider.style.width = `${width}px`;
      }

      // Initial position
      setTimeout(() => updateSlider(activeItem), 50);
      window.addEventListener('resize', () => updateSlider(activeItem));

      navItems.forEach(item => {
        item.addEventListener('mouseenter', () => updateSlider(item));
        item.addEventListener('click', (e) => {
          navItems.forEach(i => i.classList.remove('active'));
          item.classList.add('active');
          activeItem = item;
          updateSlider(activeItem);
        });
      });

      navPill.addEventListener('mouseleave', () => updateSlider(activeItem));

      /* -----------------------------------------------------------
         2. Split Statement Text into 5 Exact Lines with Word Spans
         ----------------------------------------------------------- */
      const statementLinesData = [
        "We believe the strongest brands are",
        "built through strategy, not just",
        "aesthetics. Every campaign is designed",
        "to capture attention, inspire action, and",
        "create lasting business growth."
      ];

      const statementEl = document.getElementById('statementText');
      statementEl.innerHTML = statementLinesData.map(line => {
        const words = line.split(/\s+/).map(w => `<span class="statement-word">${w}</span>`).join(' ');
        return `<span class="statement-line">${words}</span>`;
      }).join('');

      const wordSpans = statementEl.querySelectorAll('.statement-word');

      /* -----------------------------------------------------------
         3. Counting Number Animation Helper
         ----------------------------------------------------------- */
      function animateCount(elem, start, end, suffix = '+', duration = 1400) {
        if (!elem) return;
        if (prefersReducedMotion) {
          elem.innerText = end + suffix;
          return;
        }
        let startTime = null;
        function step(timestamp) {
          if (!startTime) startTime = timestamp;
          const progress = Math.min((timestamp - startTime) / duration, 1);
          // Ease out cubic
          const easeProgress = 1 - Math.pow(1 - progress, 3);
          const current = Math.floor(easeProgress * (end - start) + start);
          elem.innerText = current + suffix;
          if (progress < 1) {
            requestAnimationFrame(step);
          } else {
            elem.innerText = end + suffix;
          }
        }
        requestAnimationFrame(step);
      }

      /* -----------------------------------------------------------
         4. Load Animations (Web Animations / Staggered Transitions)
         ----------------------------------------------------------- */
      function runLoadAnimations() {
        // Nav drop in
        const heroNav = document.getElementById('heroNav');
        if (heroNav) heroNav.classList.add('is-visible');

        // Hero photo rises 40px, un-blurs and fades in over 1.3s
        const heroPhoto = document.getElementById('heroPhoto');
        if (heroPhoto) {
          setTimeout(() => {
            heroPhoto.classList.add('is-visible');
          }, 80);
        }

        // Title lines rise out of masks, 1s, staggered 110ms
        const line1 = document.getElementById('titleLine1');
        const line2 = document.getElementById('titleLine2');
        if (line1) setTimeout(() => line1.classList.add('is-visible'), 120);
        if (line2) setTimeout(() => line2.classList.add('is-visible'), 230);

        // Every other hero element rises 14px and fades in, staggered 55ms
        const heroStaggerElements = document.querySelectorAll('.anim-fade-up');
        heroStaggerElements.forEach((el, idx) => {
          setTimeout(() => {
            el.classList.add('is-visible');
          }, 320 + idx * 55);
        });

        // Q Industrial progress bar draws in
        const progressFill = document.getElementById('qProgressFill');
        if (progressFill) {
          setTimeout(() => {
            progressFill.style.width = '72%';
          }, 700);
        }

        // Counters 400+ and 230+ count up over 1.4s
        const c400 = document.getElementById('counter400');
        const c230 = document.getElementById('counter230');
        setTimeout(() => {
          animateCount(c400, 0, 400, '+', 1400);
          animateCount(c230, 0, 230, '+', 1400);
        }, 500);
      }

      /* -----------------------------------------------------------
         5. Statement Scroll Fill Calculation (with 3-word soft edge)
         ----------------------------------------------------------- */
      function updateStatementFill(progress) {
        // progress: 0.0 to 1.0
        const totalWords = wordSpans.length;
        const softEdge = 3.0;
        const currentTarget = progress * (totalWords + softEdge);

        wordSpans.forEach((span, idx) => {
          let alpha = 0; // 0 = grey, 1 = white
          if (idx <= currentTarget - softEdge) {
            alpha = 1;
          } else if (idx >= currentTarget) {
            alpha = 0;
          } else {
            alpha = (currentTarget - idx) / softEdge;
          }

          // Interpolate between grey #6f6f6f (111, 111, 111) and white #f4f4f4 (244, 244, 244)
          const r = Math.round(111 + (244 - 111) * alpha);
          const g = Math.round(111 + (244 - 111) * alpha);
          const b = Math.round(111 + (244 - 111) * alpha);
          span.style.color = `rgb(${r}, ${g}, ${b})`;
        });
      }

      /* -----------------------------------------------------------
         6. Scroll Handler & Trust Panel Triggering
         ----------------------------------------------------------- */
      const heroPhotoWrap = document.getElementById('heroPhotoWrap');
      const statementSection = document.getElementById('statement');
      const trustSection = document.getElementById('trust');
      let trustAnimated = false;

      function triggerTrustPanelAnimations() {
        if (trustAnimated) return;
        trustAnimated = true;

        // Pop in avatars with stagger
        const avatars = document.querySelectorAll('.avatar-item');
        avatars.forEach((av, i) => {
          setTimeout(() => {
            av.classList.add('popped');
          }, i * 45);
        });

        // 56M+ and 10+ count up
        const c56M = document.getElementById('counter56M');
        const c10 = document.getElementById('counter10');
        animateCount(c56M, 0, 56, 'M+', 1500);
        animateCount(c10, 0, 10, '+', 1300);
      }

      function onScroll() {
        if (isRecorder || prefersReducedMotion) return;

        const scrollY = window.scrollY;

        // Hero photo drifts at 0.12x scroll
        if (heroPhotoWrap && window.innerWidth > 760) {
          heroPhotoWrap.style.transform = `translateY(${scrollY * 0.12}px)`;
        }

        // Statement section scroll fill calculation
        if (statementSection) {
          const rect = statementSection.getBoundingClientRect();
          const windowHeight = window.innerHeight;
          const start = windowHeight * 0.85;
          const end = windowHeight * 0.15;
          const totalDistance = (rect.height + (start - end));
          const currentDistance = start - rect.top;
          let progress = Math.min(Math.max(currentDistance / totalDistance, 0), 1);
          updateStatementFill(progress);
        }

        // Trust panel entrance trigger
        if (trustSection && !trustAnimated) {
          const rect = trustSection.getBoundingClientRect();
          if (rect.top <= window.innerHeight * 0.9) {
            triggerTrustPanelAnimations();
          }
        }
      }

      // Intersection Observer for robust triggering of trust panel
      if ('IntersectionObserver' in window && !isRecorder) {
        const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              triggerTrustPanelAnimations();
            }
          });
        }, { threshold: 0.15 });

        if (trustSection) observer.observe(trustSection);
      }

      /* -----------------------------------------------------------
         7. Recorder Mode (?rec=1) Simulation Timeline
         ----------------------------------------------------------- */
      if (isRecorder) {
        // Run load animations
        runLoadAnimations();

        // Slow continuous photo drift throughout
        let driftStart = null;
        function recorderDrift(timestamp) {
          if (!driftStart) driftStart = timestamp;
          const elapsed = (timestamp - driftStart) / 1000;
          if (heroPhotoWrap && window.innerWidth > 760) {
            heroPhotoWrap.style.transform = `translateY(${elapsed * 8}px)`;
          }
          requestAnimationFrame(recorderDrift);
        }
        requestAnimationFrame(recorderDrift);

        // Statement fill: 1.3s to 4.2s
        const fillStart = 1300;
        const fillEnd = 4200;
        const fillDuration = fillEnd - fillStart;
        function updateRecorderFill(timestamp) {
          if (timestamp < fillStart) {
            updateStatementFill(0);
            requestAnimationFrame(updateRecorderFill);
          } else if (timestamp <= fillEnd) {
            const p = (timestamp - fillStart) / fillDuration;
            updateStatementFill(p);
            requestAnimationFrame(updateRecorderFill);
          } else {
            updateStatementFill(1);
          }
        }
        requestAnimationFrame(updateRecorderFill);

        // Trust counters and avatars: 3.5s to 5.2s
        setTimeout(() => {
          triggerTrustPanelAnimations();
        }, 3500);

        // Awards card lift: 5.3s
        setTimeout(() => {
          const awardsCard = document.getElementById('awardsCard');
          if (awardsCard) {
            awardsCard.style.transform = 'translateY(calc(-6 * var(--u)))';
            awardsCard.style.boxShadow = '0 16px 36px rgba(0, 0, 0, 0.45)';
          }
        }, 5300);

      } else {
        // Normal interactive browser mode
        window.addEventListener('DOMContentLoaded', runLoadAnimations);
        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll, { passive: true });
        // Initial run
        runLoadAnimations();
        onScroll();
      }

      // Reduced motion fallback
      if (prefersReducedMotion) {
        const c400 = document.getElementById('counter400');
        const c230 = document.getElementById('counter230');
        const c56M = document.getElementById('counter56M');
        const c10 = document.getElementById('counter10');
        if (c400) c400.innerText = '400+';
        if (c230) c230.innerText = '230+';
        if (c56M) c56M.innerText = '56M+';
        if (c10) c10.innerText = '10+';
        updateStatementFill(1);
        document.querySelectorAll('.avatar-item').forEach(av => av.classList.add('popped'));
      }

    })();
  </script>
</body>
</html>
