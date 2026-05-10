@extends('layouts.public')
@section('title', 'Beranda — NutriBase')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,700;0,9..144,900;1,9..144,500;1,9..144,700;1,9..144,900&display=swap" rel="stylesheet">

<style>
/* ─────────────── BASE ─────────────── */
:root {
    --g:     #0D6E35;
    --g-mid: #1a8a42;
    --g-lt:  #d4edda;
    --g-xl:  #f1faf4;
    --lime:  #b5e550;
    --ink:   #0f1a13;
    --ink-s: #3a5040;
    --ink-m: #6b8570;
    --sand:  #f8f6f1;
    --white: #ffffff;
    --r:     18px;
    --r-lg:  26px;
}

/* ═══════════════════════════════════
   HERO
═══════════════════════════════════ */
.lp-hero {
    min-height: 100svh;
    display: flex;
    align-items: center;
    background: var(--sand);
    position: relative;
    overflow: hidden;
    padding: 100px 24px 80px;
}

.lp-hero-bg {
    position: absolute; inset: 0;
    background:
        radial-gradient(ellipse 70% 55% at 72% 18%, rgba(13,110,53,0.08) 0%, transparent 60%),
        radial-gradient(ellipse 45% 45% at 18% 82%, rgba(181,229,80,0.11) 0%, transparent 55%);
    pointer-events: none;
}

.lp-hero-bg::after {background: linear-gradient(160deg, #f0fdf4 0%, #dcfce7 45%, #bbf7d0 100%);
    content: '';
    position: absolute; inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
    background-size: 200px 200px;
    opacity: .55;
    pointer-events: none;
}

/* Decorative ring */
.lp-hero-ring {
    position: absolute;
    width: 560px; height: 560px;
    border-radius: 50%;
    border: 1px solid rgba(13,110,53,0.07);
    top: 50%; right: -140px;
    transform: translateY(-50%);
    pointer-events: none;
}
.lp-hero-ring::before {
    content: '';
    position: absolute;
    width: 380px; height: 380px;
    border-radius: 50%;
    border: 1px solid rgba(13,110,53,0.05);
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
}

.lp-hero-inner {
    max-width: 1120px;
    margin: 0 auto;
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 72px;
    align-items: center;
    position: relative;
    z-index: 2;
}

/* Eyebrow */
.lp-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: white;
    border: 1px solid rgba(13,110,53,.14);
    border-radius: 100px;
    padding: 5px 14px 5px 8px;
    font-size: 10.5px;
    font-weight: 700;
    color: var(--g);
    letter-spacing: .08em;
    text-transform: uppercase;
    margin-bottom: 28px;
    opacity: 0;
    animation: slideUp .6s .1s cubic-bezier(.16,1,.3,1) forwards;
}

.lp-eyebrow-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: var(--g);
    animation: ping 2.4s ease infinite;
}

@keyframes ping {
    0%,100% { box-shadow: 0 0 0 0 rgba(13,110,53,.35); }
    60%      { box-shadow: 0 0 0 7px rgba(13,110,53,0); }
}

.lp-hero-title {
    font-family: 'Fraunces', Georgia, serif;
    font-size: clamp(2.8rem, 5.2vw, 4.4rem);
    font-weight: 900;
    color: var(--ink);
    line-height: 1.0;
    letter-spacing: -0.04em;
    margin-bottom: 26px;
    opacity: 0;
    animation: slideUp .65s .2s cubic-bezier(.16,1,.3,1) forwards;
}

.lp-hero-title .green   { color: var(--g); font-style: italic; }
.lp-hero-title .indent  { padding-left: 1.4em; display: block; }

.lp-hero-desc {
    font-size: 15px;
    color: var(--ink-s);
    line-height: 1.85;
    max-width: 390px;
    margin-bottom: 36px;
    opacity: 0;
    animation: slideUp .65s .32s cubic-bezier(.16,1,.3,1) forwards;
}

.lp-hero-ctas {
    display: flex;
    gap: 11px;
    flex-wrap: wrap;
    margin-bottom: 40px;
    opacity: 0;
    animation: slideUp .65s .42s cubic-bezier(.16,1,.3,1) forwards;
}

.btn-main {
    display: inline-flex; align-items: center; gap: 9px;
    background: var(--g);
    color: white;
    font-weight: 700; font-size: 14px;
    padding: 13px 24px;
    border-radius: 12px;
    text-decoration: none;
    letter-spacing: -.01em;
    box-shadow: 0 4px 20px rgba(13,110,53,.28), inset 0 1px 0 rgba(255,255,255,.1);
    transition: transform .22s, box-shadow .22s;
}
.btn-main:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(13,110,53,.38); }

.btn-ghost {
    display: inline-flex; align-items: center; gap: 8px;
    background: transparent;
    border: 1.5px solid rgba(13,110,53,.22);
    color: var(--ink);
    font-weight: 600; font-size: 14px;
    padding: 13px 22px;
    border-radius: 12px;
    text-decoration: none;
    transition: all .2s;
}
.btn-ghost:hover { border-color: var(--g); color: var(--g); background: var(--g-xl); }

/* Right visual */
.lp-hero-visual {
    opacity: 0;
    animation: fadeIn .8s .5s ease forwards;
    position: relative;

    width: 100%;
    max-width: 680px; /* ubah ukuran box */
    margin-left: auto;
}

.lp-hero-visual img {
    width: 100%;
    height: auto;
    display: block;
    transform: scale(1.15); /* sedikit diperbesar */
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes fadeIn {
    from { opacity: 0; transform: scale(.97) translateY(10px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}

/* Mockup card */
.mockup-wrap {
    border-radius: var(--r-lg);
    background: white;
    box-shadow: 0 0 0 1px rgba(13,110,53,.07), 0 28px 72px rgba(0,0,0,.10), 0 8px 24px rgba(0,0,0,.05);
    overflow: hidden;
}

.mockup-topbar {
    background: var(--g);
    padding: 11px 16px;
    display: flex; align-items: center; gap: 10px;
}

.mockup-dots { display: flex; gap: 5px; }
.mockup-dots span {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: rgba(255,255,255,.25);
}
.mockup-dots span:first-child { background: rgba(255,255,255,.65); }

.mockup-title-bar {
    flex: 1; background: rgba(255,255,255,.1);
    border-radius: 6px; height: 20px;
    display: flex; align-items: center; justify-content: center;
}
.mockup-title-bar span { font-size: 11px; font-weight: 600; color: rgba(255,255,255,.7); letter-spacing: .03em; }

.mockup-body { padding: 18px 18px 22px; background: #f9fbf9; }

.mockup-stats { display: grid; grid-template-columns: repeat(3,1fr); gap: 9px; margin-bottom: 14px; }

.m-stat {
    background: white;
    border: 1px solid rgba(13,110,53,.07);
    border-radius: 11px;
    padding: 13px 11px;
}

.m-stat-num {
    font-size: 21px; font-weight: 800;
    color: var(--ink); letter-spacing: -.04em;
    font-family: 'Fraunces', serif;
    line-height: 1; margin-bottom: 5px;
}
.m-stat-num.green { color: var(--g); }
.m-stat-label { font-size: 9.5px; text-transform: uppercase; letter-spacing: .06em; font-weight: 700; color: var(--ink-m); }

.mockup-dist-label { font-size: 10px; font-weight: 700; color: var(--ink-m); text-transform: uppercase; letter-spacing: .07em; margin-bottom: 7px; }
.mockup-dist-list { display: flex; flex-direction: column; gap: 6px; }

.dist-row {
    display: flex; align-items: center; gap: 9px;
    background: white; border-radius: 8px;
    padding: 8px 11px; border: 1px solid rgba(13,110,53,.06);
}
.dist-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
.dist-name { font-size: 11.5px; font-weight: 600; color: var(--ink); flex: 1; }
.dist-badge { font-size: 9.5px; font-weight: 700; padding: 3px 8px; border-radius: 100px; }
.dist-badge.ok   { background: rgba(13,110,53,.1); color: var(--g); }
.dist-badge.pend { background: rgba(234,179,8,.12); color: #a16207; }

.mockup-chart { margin-top: 13px; }
.chart-row { display: flex; align-items: center; gap: 9px; margin-bottom: 7px; }
.chart-lbl { font-size: 10.5px; color: var(--ink-m); font-weight: 500; width: 50px; flex-shrink: 0; }
.chart-track { flex: 1; height: 5px; border-radius: 100px; background: rgba(13,110,53,.07); overflow: hidden; }
.chart-bar { height: 100%; border-radius: 100px; background: linear-gradient(90deg, var(--g), #27ae60); animation: growBar 1.4s .9s cubic-bezier(.16,1,.3,1) both; transform-origin: left; }
@keyframes growBar { from { width: 0 !important; } }
.chart-pct { font-size: 10.5px; font-weight: 700; color: var(--g); width: 26px; text-align: right; }

/* Floating chips */
.chip-float {
    position: absolute; background: white;
    border-radius: 14px; border: 1px solid rgba(13,110,53,.1);
    box-shadow: 0 8px 28px rgba(0,0,0,.09);
    display: flex; align-items: center; gap: 10px;
    padding: 10px 15px; font-size: 12px;
}
.chip-float-1 { top: -18px; right: -16px; animation: chipBob1 4.5s ease-in-out infinite; }
.chip-float-2 { bottom: -16px; left: -14px; animation: chipBob2 5s .8s ease-in-out infinite; }
@keyframes chipBob1 { 0%,100% { transform: translateY(0) rotate(-1deg); } 50% { transform: translateY(-8px) rotate(1deg); } }
@keyframes chipBob2 { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-7px); } }
.chip-icon { width: 28px; height: 28px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.chip-icon i { font-size: 13px; }
.chip-text strong { display: block; color: var(--ink); font-weight: 700; font-size: 12px; line-height: 1; margin-bottom: 2px; }
.chip-text span { color: var(--ink-m); font-size: 10.5px; }

/* ═══════════════════════════════════
   MARQUEE
═══════════════════════════════════ */
.lp-marquee-wrap {
    background: var(--g);
    padding: 13px 0;
    overflow: hidden;
}
.lp-marquee-track {
    display: flex; gap: 0;
    width: max-content;
    animation: marquee 28s linear infinite;
}
@keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
.lp-marquee-item {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 0 30px;
    font-size: 12px; font-weight: 700;
    color: rgba(255,255,255,.8);
    letter-spacing: .05em; text-transform: uppercase; white-space: nowrap;
}
.lp-marquee-item::after { content: '✦'; font-size: 7px; color: var(--lime); margin-left: 18px; }

/* ═══════════════════════════════════
   SHARED SECTION STYLES
═══════════════════════════════════ */
.lp-section-inner { max-width: 1120px; margin: 0 auto; }

.lp-section-head {
    display: flex; align-items: flex-end;
    justify-content: space-between; gap: 32px;
    margin-bottom: 56px;
}

.lp-label {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 10px; font-weight: 800;
    color: var(--g); letter-spacing: .1em; text-transform: uppercase;
    background: var(--g-xl); border: 1px solid rgba(13,110,53,.13);
    border-radius: 100px; padding: 5px 13px 5px 10px; margin-bottom: 14px;
}
.lp-label-dot { width: 6px; height: 6px; background: var(--g); border-radius: 50%; }

.lp-h2 {
    font-family: 'Fraunces', Georgia, serif;
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 900; color: var(--ink);
    line-height: 1.08; letter-spacing: -.04em;
}
.lp-h2 em { color: var(--g); font-style: italic; }

.lp-section-aside {
    font-size: 14px; color: var(--ink-m);
    line-height: 1.8; max-width: 230px;
    text-align: right; flex-shrink: 0;
}

/* ═══════════════════════════════════
   FEATURES
═══════════════════════════════════ */
.lp-features { padding: 110px 24px; background: var(--white); }

.feat-grid {
    display: grid;
    grid-template-columns: 1.2fr 1fr 1fr;
    grid-template-rows: auto auto;
    gap: 14px;
}

.feat-card {
    background: var(--sand);
    border: 1px solid rgba(13,110,53,.07);
    border-radius: var(--r);
    padding: 28px 26px;
    transition: all .3s cubic-bezier(.16,1,.3,1);
    position: relative; overflow: hidden;
}

.feat-card::before {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(13,110,53,.04), transparent 50%);
    opacity: 0; transition: opacity .3s;
}
.feat-card:hover { border-color: rgba(13,110,53,.18); box-shadow: 0 14px 40px rgba(13,110,53,.09); transform: translateY(-4px); }
.feat-card:hover::before { opacity: 1; }

.feat-card--big {
    grid-row: span 2;
    background: var(--g); border-color: var(--g);
    display: flex; flex-direction: column; justify-content: flex-end;
    min-height: 300px; padding: 34px 30px;
}
.feat-card--big::before { background: radial-gradient(circle at 80% 20%, rgba(181,229,80,.18), transparent 60%); opacity: 1; }
.feat-card--big:hover { box-shadow: 0 20px 60px rgba(13,110,53,.32); transform: translateY(-5px); }

.feat-icon-wrap { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; }
.feat-icon-wrap i { font-size: 19px; }

.feat-num {
    font-family: 'Fraunces', serif;
    font-size: 4.2rem; font-weight: 900;
    color: rgba(181,229,80,.22);
    letter-spacing: -.06em; line-height: 1;
    margin-bottom: auto; padding-bottom: 14px;
}

.feat-card--big .feat-h3 { font-family: 'Fraunces', serif; font-size: 21px; font-weight: 800; color: white; letter-spacing: -.03em; margin-bottom: 9px; }
.feat-card--big .feat-p  { font-size: 13.5px; color: rgba(255,255,255,.6); line-height: 1.75; }

.feat-h3 { font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 8px; letter-spacing: -.02em; }
.feat-p  { font-size: 13px; color: var(--ink-m); line-height: 1.78; }

/* ═══════════════════════════════════
   NUMBERS
═══════════════════════════════════ */
.lp-numbers {
    padding: 76px 24px;
    background: var(--sand);
    border-top: 1px solid rgba(13,110,53,.07);
    border-bottom: 1px solid rgba(13,110,53,.07);
}

.numbers-grid { max-width: 1120px; margin: 0 auto; display: grid; grid-template-columns: repeat(4,1fr); gap: 2px; }

.num-cell { text-align: center; padding: 30px 20px; position: relative; }
.num-cell + .num-cell::before {
    content: ''; position: absolute;
    left: 0; top: 20%; height: 60%; width: 1px;
    background: rgba(13,110,53,.1);
}

.num-val { font-family: 'Fraunces', serif; font-size: clamp(2.4rem, 4vw, 3.4rem); font-weight: 900; color: var(--g); letter-spacing: -.05em; line-height: 1; margin-bottom: 10px; display: block; }
.num-suffix { font-size: 1.5rem; vertical-align: super; }
.num-label { font-size: 12.5px; color: var(--ink-m); font-weight: 500; line-height: 1.5; }

/* ═══════════════════════════════════
   HOW IT WORKS
═══════════════════════════════════ */
.lp-how { padding: 110px 24px; background: var(--white); }

.how-grid {
    display: grid; grid-template-columns: repeat(3,1fr);
    gap: 24px; margin-top: 56px; position: relative;
}
.how-grid::before {
    content: ''; position: absolute;
    top: 31px; left: calc(16.66% + 14px); right: calc(16.66% + 14px);
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(13,110,53,.18) 20%, rgba(13,110,53,.18) 80%, transparent);
    pointer-events: none;
}

.how-step { text-align: center; padding: 0 16px; }

.how-num {
    width: 62px; height: 62px; border-radius: 50%;
    background: var(--g-xl); border: 1px solid rgba(13,110,53,.14);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 22px;
    font-family: 'Fraunces', serif; font-size: 21px; font-weight: 900; color: var(--g);
    position: relative; z-index: 1;
    transition: all .3s;
}
.how-step:hover .how-num { background: var(--g); color: white; border-color: var(--g); transform: scale(1.08); }
.how-step h3 { font-size: 15.5px; font-weight: 700; color: var(--ink); margin-bottom: 9px; letter-spacing: -.02em; }
.how-step p  { font-size: 13.5px; color: var(--ink-m); line-height: 1.8; }

/* ═══════════════════════════════════
   CTA
═══════════════════════════════════ */
.lp-cta-wrap { padding: 80px 24px 0; background: var(--white); }

.lp-cta-box {
    max-width: 1120px; margin: 0 auto;
    background: var(--ink); border-radius: var(--r-lg);
    padding: 76px 60px;
    display: grid; grid-template-columns: 1fr auto;
    align-items: center; gap: 52px;
    position: relative; overflow: hidden;
}
.lp-cta-box::before {
    content: ''; position: absolute;
    top: -90px; right: -70px;
    width: 420px; height: 420px;
    background: radial-gradient(circle, rgba(13,110,53,.28) 0%, transparent 65%);
    pointer-events: none;
}
.lp-cta-box::after {
    content: ''; position: absolute;
    bottom: -70px; left: 28%;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(181,229,80,.07) 0%, transparent 65%);
    pointer-events: none;
}

.lp-cta-label {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 10px; font-weight: 800; color: var(--lime);
    letter-spacing: .1em; text-transform: uppercase;
    margin-bottom: 18px;
}
.lp-cta-label span { width: 6px; height: 6px; background: var(--lime); border-radius: 50%; }

.lp-cta-box h2 {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.9rem, 3.4vw, 2.7rem);
    font-weight: 900; color: white;
    letter-spacing: -.04em; line-height: 1.1;
    margin-bottom: 13px; position: relative;
}
.lp-cta-box h2 em { color: var(--lime); font-style: italic; }
.lp-cta-box p { font-size: 14px; color: rgba(255,255,255,.42); line-height: 1.78; position: relative; }

.lp-cta-action { flex-shrink: 0; position: relative; z-index: 1; }

.btn-cta {
    display: inline-flex; align-items: center; gap: 10px;
    background: var(--lime); color: var(--ink);
    font-size: 15px; font-weight: 800;
    padding: 16px 28px; border-radius: 13px;
    text-decoration: none; letter-spacing: -.02em;
    box-shadow: 0 4px 24px rgba(181,229,80,.32);
    transition: all .28s cubic-bezier(.175,.885,.32,1.275);
    white-space: nowrap;
}
.btn-cta:hover { transform: translateY(-3px) scale(1.04); box-shadow: 0 14px 36px rgba(181,229,80,.48); }

/* ═══════════════════════════════════
   SCROLL REVEAL
═══════════════════════════════════ */
.reveal {
    opacity: 0;
    transform: translateY(24px);
    transition: opacity .6s cubic-bezier(.16,1,.3,1), transform .6s cubic-bezier(.16,1,.3,1);
}
.reveal.in { opacity: 1; transform: none; }

/* ═══════════════════════════════════
   RESPONSIVE
═══════════════════════════════════ */

/* TABLET & LAPTOP KECIL */
@media (max-width: 1024px) {

    .lp-hero-inner {
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: center;
    }

    .lp-hero-title {
        font-size: clamp(2.4rem, 5vw, 3.8rem);
    }

    .lp-hero-desc {
        max-width: 100%;
    }

    .lp-hero-visual {
        max-width: 520px;
        margin-left: auto;
    }

    .lp-hero-visual img {
        width: 100%;
        height: auto;
        display: block;
    }

    .feat-grid {
        grid-template-columns: 1fr 1fr;
    }

    .feat-card--big {
        grid-row: span 1;
        min-height: 200px;
    }

    .how-grid::before {
        display: none;
    }

    .lp-cta-box {
        grid-template-columns: 1fr;
        padding: 48px 32px;
        text-align: center;
        gap: 28px;
    }

    .btn-cta {
        width: 100%;
        justify-content: center;
    }

    .numbers-grid {
        grid-template-columns: repeat(2,1fr);
    }

    .lp-section-head {
        flex-direction: column;
        align-items: flex-start;
    }

    .lp-section-aside {
        text-align: left;
        max-width: 100%;
    }
}

/* MOBILE */
@media (max-width: 768px) {

    .lp-hero-inner {
        grid-template-columns: 1fr;
        gap: 50px;
    }

    .lp-hero {
        padding-top: 120px;
        text-align: center;
    }

    .lp-hero-desc {
        margin-inline: auto;
    }

    .lp-hero-ctas {
        justify-content: center;
    }

    .lp-hero-visual {
        max-width: 420px;
        margin: 0 auto;
    }

    .lp-hero-title .indent {
        padding-left: 0;
    }

    .feat-grid {
        grid-template-columns: 1fr;
    }

    .how-grid {
        grid-template-columns: 1fr;
    }

    .lp-hero-title {
        font-size: 2.6rem;
    }
}

</style>

{{-- ── HERO ── --}}
<section class="lp-hero">
    <div class="lp-hero-bg"></div>
    <div class="lp-hero-ring"></div>

    <div class="lp-hero-inner">

        {{-- Left --}}
        <div>
            <div class="lp-eyebrow">
                <div class="lp-eyebrow-dot"></div>
                Platform MBG Indonesia
            </div>

            <h1 class="lp-hero-title">
                Makanan Bergizi,<br>
                <span class="green">Lebih Mudah</span><br>
                <span class="indent">Sampai.</span>
            </h1>

            <p class="lp-hero-desc">
                NutriBase membantu kader, koordinator, dan penerima program Makanan Bergizi Gratis bekerja dalam satu platform yang jelas, cepat, dan transparan.
            </p>

            <div class="lp-hero-ctas">
                <a href="{{ route('login') }}" class="btn-main">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk Sekarang
                </a>
                <a href="{{ route('tentang') }}" class="btn-ghost">
                    Pelajari Program <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        {{-- Right: mockup --}}
{{-- Right --}}
<div class="lp-hero-visual">
    <img src="{{ asset('storage/beranda/nutribase_hero_illustration.svg') }}" 
         alt="Nutribase Hero Illustration">
</div>

</section>

{{-- ── MARQUEE ── --}}
<div class="lp-marquee-wrap">
    <div class="lp-marquee-track">
        @for($i = 0; $i < 2; $i++)
        <div class="lp-marquee-item"><i class="bi bi-patch-check-fill"></i>Manajemen Penerima</div>
        <div class="lp-marquee-item"><i class="bi bi-truck"></i>Distribusi Real-time</div>
        <div class="lp-marquee-item"><i class="bi bi-bar-chart-line"></i>Laporan & Analitik</div>
        <div class="lp-marquee-item"><i class="bi bi-calendar3"></i>Jadwal & Menu</div>
        <div class="lp-marquee-item"><i class="bi bi-shield-check"></i>Akses Berbasis Peran</div>
        <div class="lp-marquee-item"><i class="bi bi-star-fill"></i>Ulasan Penerima</div>
        <div class="lp-marquee-item"><i class="bi bi-graph-up-arrow"></i>Monitoring Stok</div>
        <div class="lp-marquee-item"><i class="bi bi-people-fill"></i>Multi-user</div>
        @endfor
    </div>
</div>

{{-- ── FEATURES ── --}}
<section class="lp-features">
    <div class="lp-section-inner">
        <div class="lp-section-head reveal">
            <div>
                <div class="lp-label"><span class="lp-label-dot"></span> Fitur Utama</div>
                <h2 class="lp-h2">Semua yang diperlukan,<br><em>sudah ada di sini.</em></h2>
            </div>
            <p class="lp-section-aside">Dirancang khusus untuk kebutuhan lapangan program MBG.</p>
        </div>

        <div class="feat-grid reveal">


            <div class="feat-card" style="transition-delay:.07s;">
                <div class="feat-icon-wrap" style="background:var(--g-xl);">
                    <i class="bi bi-people-fill" style="color:var(--g);"></i>
                </div>
                <h3 class="feat-h3">DDistribusi Real-time</h3>
                <p class="feat-p">Pantau dan catat setiap proses distribusi secara langsung. Status otomatis terupdate — penerima tidak perlu menunggu konfirmasi manual.</p>
            </div>


            <div class="feat-card" style="transition-delay:.07s;">
                <div class="feat-icon-wrap" style="background:var(--g-xl);">
                    <i class="bi bi-people-fill" style="color:var(--g);"></i>
                </div>
                <h3 class="feat-h3">Data Penerima Terpusat</h3>
                <p class="feat-p">Kelola profil penerima lengkap termasuk kategori, NIK, lokasi, dan estimasi durasi bantuan dalam satu tempat.</p>
            </div>

            <div class="feat-card" style="transition-delay:.14s;">
                <div class="feat-icon-wrap" style="background:var(--g-xl);">
                    <i class="bi bi-bar-chart-line-fill" style="color:var(--g);"></i>
                </div>
                <h3 class="feat-h3">Laporan & Analitik</h3>
                <p class="feat-p">Dashboard koordinator dengan grafik realisasi, performa kader, dan ekspor laporan PDF siap presentasi.</p>
            </div>

            <div class="feat-card" style="transition-delay:.21s;">
                <div class="feat-icon-wrap" style="background:rgba(234,179,8,.1);">
                    <i class="bi bi-calendar3" style="color:#a16207;"></i>
                </div>
                <h3 class="feat-h3">Jadwal & Variasi Menu</h3>
                <p class="feat-p">Atur jadwal distribusi mingguan dan rotasi menu bergizi agar program berjalan terstruktur setiap saat.</p>
            </div>

            <div class="feat-card" style="transition-delay:.28s;">
                <div class="feat-icon-wrap" style="background:var(--g-xl);">
                    <i class="bi bi-shield-check" style="color:var(--g);"></i>
                </div>
                <h3 class="feat-h3">Akses Berbasis Peran</h3>
                <p class="feat-p">Kader, Koordinator, dan Penerima — masing-masing mendapat tampilan dan fitur yang sesuai tanggung jawabnya.</p>
            </div>

            <div class="feat-card" style="transition-delay:.35s;">
                <div class="feat-icon-wrap" style="background:rgba(239,68,68,.07);">
                    <i class="bi bi-star-fill" style="color:#dc2626;"></i>
                </div>
                <h3 class="feat-h3">Ulasan & Tanggapan</h3>
                <p class="feat-p">Penerima memberi ulasan, kader merespons. Loop feedback yang membantu program terus berkembang.</p>
            </div>
        </div>
    </div>
</section>

{{-- ── NUMBERS ── --}}
<section class="lp-numbers">
    <div class="numbers-grid reveal">
        <div class="num-cell">
            <span class="num-val">3<span class="num-suffix">+</span></span>
            <div class="num-label">Jenis Pengguna<br>dalam Satu Sistem</div>
        </div>
        <div class="num-cell">
            <span class="num-val">100<span class="num-suffix">%</span></span>
            <div class="num-label">Distribusi<br>Tertelusuri</div>
        </div>
        <div class="num-cell">
            <span class="num-val">0</span>
            <div class="num-label">Data Tercecer,<br>Semua Tercatat</div>
        </div>
        <div class="num-cell">
            <span class="num-val">∞</span>
            <div class="num-label">Riwayat Distribusi<br>Tersimpan</div>
        </div>
    </div>
</section>

{{-- ── HOW IT WORKS ── --}}
<section class="lp-how">
    <div class="lp-section-inner">
        <div class="lp-section-head reveal" style="justify-content:flex-start;">
            <div>
                <div class="lp-label"><span class="lp-label-dot"></span> Cara Kerja</div>
                <h2 class="lp-h2">Tiga langkah,<br><em>satu alur kerja.</em></h2>
            </div>
        </div>

        <div class="how-grid">
            <div class="how-step reveal" style="transition-delay:.05s;">
                <div class="how-num">01</div>
                <h3>Kader Catat Distribusi</h3>
                <p>Kader mencatat setiap distribusi beserta status — diterima, pending, atau gagal — langsung dari platform.</p>
            </div>
            <div class="how-step reveal" style="transition-delay:.15s;">
                <div class="how-num">02</div>
                <h3>Penerima Beri Ulasan</h3>
                <p>Penerima membuka riwayat distribusinya dan memberikan rating serta ulasan atas bantuan yang diterima.</p>
            </div>
            <div class="how-step reveal" style="transition-delay:.25s;">
                <div class="how-num">03</div>
                <h3>Koordinator Pantau</h3>
                <p>Koordinator memantau laporan menyeluruh, merespons ulasan, dan mengambil keputusan berbasis data nyata.</p>
            </div>
        </div>
    </div>
</section>

{{-- ── CTA ── --}}
<section class="lp-cta-wrap">
    <div class="lp-cta-box reveal">
        <div>
            <div class="lp-cta-label"><span></span> Siap Mulai?</div>
            <h2>Program lebih rapi,<br><em>mulai hari ini.</em></h2>
            <p>Masuk ke NutriBase dan kelola distribusi program Makanan Bergizi Gratis dengan cara yang lebih modern dan transparan.</p>
        </div>
        <div class="lp-cta-action">
            <a href="{{ route('login') }}" class="btn-cta">
                <i class="bi bi-box-arrow-in-right"></i> Masuk ke Sistem
            </a>
        </div>
    </div>
</section>

<script>
const reveals = document.querySelectorAll('.reveal');
const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
    });
}, { threshold: 0.1 });
reveals.forEach(el => io.observe(el));
</script>

@endsection