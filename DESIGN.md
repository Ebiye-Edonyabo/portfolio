# Ares Dashboard - Design System Documentation

This document outlines the visual guidelines, design tokens, typography, layout grid, and CSS component specifications for the **Ares Admin Dashboard** on Ebiye's portfolio project.

This design system is built specifically around your portfolio's brand: a modern, dark-first, glassmorphic UI characterized by **Instrument Sans typography, deep-black (#0a0a0a) canvas surfaces, and neon lime green accents**.

## Table of Contents
1. [Design Philosophy](#1-design-philosophy)
2. [Color System](#2-color-system)
   * [2.1 Primitive Palette](#21-primitive-palette)
   * [2.2 Semantic Token Map](#22-semantic-token-map)
3. [Typography](#3-typography)
   * [3.1 Typeface](#31-typeface)
   * [3.2 Type Scale](#32-type-scale)
   * [3.3 Number Formatting](#33-number-formatting)
4. [Spacing & Layout Grid](#4-spacing--layout-grid)
   * [4.1 Base Unit](#41-base-unit)
   * [4.2 App Shell Layout](#42-app-shell-layout)
   * [4.3 Card Grid](#43-card-grid)
5. [Elevation & Shadow](#5-elevation--shadow)
6. [Iconography](#6-iconography)
   * [Icon Usage Map](#icon-usage-map)
7. [Components](#7-components)
   * [7.1 Sidebar / Navigation](#71-sidebar--navigation)
   * [7.2 Top Bar / Header](#72-top-bar--header)
   * [7.3 Stat Cards](#73-stat-cards)
   * [7.4 Chart Cards](#74-chart-cards)
   * [7.5 Bar Charts](#75-bar-charts)
   * [7.6 Sales Distribution Card](#76-sales-distribution-card)
   * [7.7 Integration List Card](#77-integration-list-card)
   * [7.8 Buttons](#78-buttons)
   * [7.9 Badges & Tags](#79-badges--tags)
   * [7.10 Dropdowns & Selects](#710-dropdowns--selects)
   * [7.11 Search Bar](#711-search-bar)
   * [7.12 Progress Bars](#712-progress-bars)
   * [7.13 Checkboxes](#713-checkboxes)
   * [7.14 Avatar](#714-avatar)
   * [7.15 Tooltips](#715-tooltips)
8. [Dark Mode](#8-dark-mode)
   * [Dark Mode Component Adjustments](#dark-mode-component-adjustments)
9. [Motion & Interaction States](#9-motion--interaction-states)
   * [Transition Defaults](#transition-defaults)
   * [State Table](#state-table)
   * [Chart Animations (recommended)](#chart-animations-recommended)
10. [Accessibility](#10-accessibility)
11. [Responsive Behaviour](#11-responsive-behaviour)

---

## 1. Design Philosophy

The Ares Design System emphasizes a **high-contrast, dark-first developer aesthetic**. It focuses on:
* **Minimalist Structural Borders:** Visual hierarchy is defined by thin border containers and background tones, rather than heavy drop shadows.
* **Vibrant Accent Anchors:** High-visibility lime green is used sparingly for active states, indicators, and primary CTAs to create a premium neon-dark aesthetic.
* **Precision Typography:** Clean vertical layouts with optimized tabular metrics for code logging and analytics.

---

## 2. Color System

### 2.1 Primitive Palette

Define these variables in your root CSS or [app.css](file:///c:/Users/EBI/Develop/others/portfolio/resources/css/app.css):

```css
:root {
  /* --- Primitive Canvas Shades --- */
  --color-black-pure:    #000000;
  --color-black-app:     #0a0a0a;   /* Primary body background */
  --color-black-sidebar: #0d0d0d;   /* Sidebar panel */
  --color-black-card:    #121212;   /* Default card background */
  --color-black-hover:   #171717;   /* Row/list hover state */
  --color-border-dark:   #1f1f1f;   /* Structural borders */
  --color-border-accent: #3f6212;   /* Dark lime highlight border */

  /* --- Text --- */
  --color-text-white:    #ffffff;   /* Primary headings */
  --color-text-gray-300: #d1d5db;   /* Standard body copy */
  --color-text-gray-400: #9ca3af;   /* Muted labels / subtext */
  --color-text-gray-600: #4b5563;   /* Placeholders */

  /* --- Brand Primary (Lime Green) --- */
  --color-primary-100:   #d9f99d;   /* Light lime */
  --color-primary-300:   #84cc16;   /* Main neon lime highlights */
  --color-primary-500:   #3f6212;   /* Dark lime */

  /* --- Semantic States --- */
  --color-positive:      #84cc16;   /* Success green (uses brand lime) */
  --color-positive-bg:   rgba(132, 204, 22, 0.1);
  --color-negative:      #ef4444;   /* Error/Decline red */
  --color-negative-bg:   rgba(239, 68, 68, 0.1);
  --color-warning:       #f59e0b;   /* Pending/Warning amber */
  --color-warning-bg:    rgba(245, 158, 11, 0.1);
}
```

### 2.2 Semantic Token Map

| Token | Light/Dark Value | Usage |
| :--- | :--- | :--- |
| `--bg-app` | `#0a0a0a` | App shell backdrop canvas |
| `--bg-sidebar` | `#0d0d0d` | Sidebar main navigation background |
| `--bg-card` | `#121212` | Card body panels |
| `--bg-card-hover` | `#171717` | Cards, rows, and buttons hover |
| `--bg-input` | `#171717` | Search input, text inputs, dropdowns |
| `--bg-sidebar-active`| `#1e2d0a` | Active / selected sidebar list item |
| `--text-heading` | `#ffffff` | Primary titles, counts, large values |
| `--text-body` | `#d1d5db` | General description body copy |
| `--text-muted` | `#9ca3af` | Form labels, metadata captions, subtext |
| `--text-placeholder` | `#4b5563` | Search / Input placeholder values |
| `--border-default` | `#1f1f1f` | Component borders and list dividers |
| `--border-input` | `#1f1f1f` | Input borders |
| `--accent-chart` | `#84cc16` | Main accent chart fill color |
| `--accent-chart-alt` | `#3f6212` | Secondary chart fill color |

---

## 3. Typography

### 3.1 Typeface

The dashboard matches the portfolio typeface stack using **Instrument Sans**.

```css
:root {
  --font-family-base: 'Instrument Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}
```

### 3.2 Type Scale

| Role | Size | Weight | Line Height | Letter Spacing | Color Token |
| :--- | :--- | :--- | :--- | :--- | :--- |
| Page Title | `26px` | `700` | `1.2` | `-0.01em` | `--text-heading` |
| Card Title | `14px` | `600` | `1.4` | `0` | `--text-body` |
| Stat Number (large) | `30px` | `700` | `1` | `-0.02em` | `--text-heading` |
| Stat Number (medium)| `22px` | `700` | `1` | `-0.01em` | `--text-heading` |
| Badge / Tag Label | `11px` | `500` | `1` | `0.01em` | Semantic |
| Body / Labels | `13px` | `400` | `1.5` | `0` | `--text-body` |
| Caption / Meta | `12px` | `400` | `1.4` | `0` | `--text-muted` |
| Nav Link Label | `14px` | `500` | `1` | `0` | `--text-body` |
| Nav Section Header | `11px` | `600` | `1` | `0.06em` | `--text-muted` |
| Table Header | `11px` | `600` | `1` | `0.04em` | `--text-muted` |
| Table Cell Text | `13px` | `400` | `1` | `0` | `--text-body` |
| Button Text | `13px` | `600` | `1` | `0` | Contextual |

### 3.3 Number Formatting

All quantitative metrics and charts use tabular numbers to align layout columns:

```css
.tabular-metrics {
  font-variant-numeric: tabular-nums;
}
```

---

## 4. Spacing & Layout Grid

### 4.1 Base Unit

Spacing operates on an **8px base unit system**:

```
4px   -> xs   (tight alignments, button gap paddings)
8px   -> sm   (spacing between text blocks)
12px  -> md   (inner widget gaps, lists)
16px  -> lg   (internal card elements)
24px  -> xl   (padding in cards, page borders)
32px  -> 2xl  (spacing between sections)
```

### 4.2 App Shell Layout

```
+-----------------------------------------------------------------------+
|  TOP BAR  height = 56px  (fixed, borders, logo left, avatar right)    |
+-------------------+---------------------------------------------------+
|                   |                                                   |
|  SIDEBAR          |  MAIN CONTENT CANVAS AREA                         |
|  width = 260px    |  padding: 24px 28px                               |
|  fixed left       |  overflow-y: auto                                 |
|                   |                                                   |
+-------------------+---------------------------------------------------+
```

### 4.3 Card Grid

Dashboard interfaces layout on a responsive **12-column grid configuration**:

```css
.dashboard-grid {
  display: grid;
  grid-template-columns: repeat(12, 1fr);
  gap: 20px;
}
.stat-card-widget   { grid-column: span 3; } /* 4 columns on large screens */
.chart-widget-main  { grid-column: span 8; }
.chart-widget-side  { grid-column: span 4; }
.table-widget-full  { grid-column: span 12; }
```

---

## 5. Elevation & Shadow

Ares Dashboard utilizes **flat elevations**. Depth is generated through layout borders (`var(--border-default)`) and background contrast changes.

```css
/* Cards, Sidebar, Top Bar */
.card-flat {
  background: var(--bg-card);
  border: 1px solid var(--border-default);
  border-radius: 12px;
}

/* Floating components (dropdowns, tooltips) */
.floating-overlay {
  background: var(--bg-card);
  border: 1px solid var(--border-default);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3);
}
```

| Layer | Background | Border | Shadow |
| :--- | :--- | :--- | :--- |
| App BG | `#0a0a0a` | — | — |
| Sidebar | `#0d0d0d` | `#1f1f1f` right | — |
| Card | `#121212` | `#1f1f1f` all | — |
| Dropdown | `#121212` | `#1f1f1f` | `0 4px 16px rgba(0,0,0,0.5)` |

---

## 6. Iconography

The dashboard uses **FontAwesome (v6 Free)** vector icons, aligning with Ebiye's portfolio stack. All icons inherit a standardized `16px` size inside layouts.

### Icon Usage Map

| UI Role | FontAwesome Icon Class | Color Value |
| :--- | :--- | :--- |
| Dashboard Link | `fa-solid fa-chart-line` | `var(--text-muted)` |
| Projects Link | `fa-solid fa-folder` | `var(--text-muted)` |
| Experience Link | `fa-solid fa-briefcase` | `var(--text-muted)` |
| Messages Link | `fa-solid fa-envelope` | `var(--text-muted)` |
| Logs / Activity Link | `fa-solid fa-terminal` | `var(--text-muted)` |
| Settings Link | `fa-solid fa-sliders` | `var(--text-muted)` |
| Search Indicator | `fa-solid fa-magnifying-glass` | `var(--text-muted)` |
| Date Picker | `fa-solid fa-calendar` | `var(--text-muted)` |
| Download Actions | `fa-solid fa-download` | `var(--text-muted)` |
| Trend Indicator (Up) | `fa-solid fa-arrow-trend-up` | `var(--color-primary-300)` |
| Trend Indicator (Down)| `fa-solid fa-arrow-trend-down` | `var(--color-negative)` |

---

## 7. Components

### 7.1 Sidebar / Navigation

```css
.sidebar {
  width: 260px;
  background: var(--bg-sidebar);
  border-right: 1px solid var(--border-default);
  display: flex;
  flex-direction: column;
  height: 100vh;
}
.sidebar__link {
  display: flex;
  align-items: center;
  padding: 10px 16px;
  color: var(--text-body);
  border-left: 3px solid transparent;
  gap: 12px;
  font-size: 14px;
  transition: all var(--transition-fast);
}
.sidebar__link:hover {
  background: rgba(132, 204, 22, 0.04);
  color: var(--text-heading);
}
.sidebar__link--active {
  background: var(--bg-active);
  color: var(--text-heading);
  border-left-color: var(--color-primary-300);
}
```

### 7.2 Top Bar / Header

```css
.topbar {
  height: 56px;
  background: var(--bg-sidebar);
  border-bottom: 1px solid var(--border-default);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 24px;
}
```

### 7.3 Stat Cards

```css
.stat-card {
  background: var(--bg-card);
  border: 1px solid var(--border-default);
  border-radius: 12px;
  padding: 20px;
  transition: border-color var(--transition-base);
}
.stat-card:hover {
  border-color: var(--border-accent);
}
.stat-card__value {
  font-size: 30px;
  font-weight: 700;
  color: var(--text-heading);
  font-variant-numeric: tabular-nums;
  margin-top: 8px;
}
```

### 7.4 Chart Cards

```css
.chart-card {
  background: var(--bg-card);
  border: 1px solid var(--border-default);
  border-radius: 12px;
  padding: 24px;
}
.chart-card__header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}
```

### 7.5 Bar Charts

```css
.bar-chart {
  display: flex;
  align-items: flex-end;
  height: 200px;
  gap: 12px;
}
.bar-chart__col {
  flex: 1;
  background: var(--color-primary-500);
  border-radius: 4px 4px 0 0;
  transition: background var(--transition-fast);
}
.bar-chart__col:hover {
  background: var(--color-primary-300);
}
```

### 7.6 Sales Distribution Card

```css
.donut-chart {
  position: relative;
  width: 140px;
  height: 140px;
  margin: 0 auto;
}
.donut-chart__legend {
  margin-top: 16px;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 8px;
}
```

### 7.7 Integration List Card

```css
.integration-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.integration-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px;
  border: 1px solid var(--border-default);
  border-radius: 8px;
  background: var(--bg-sidebar);
}
```

### 7.8 Buttons

```css
.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 8px 16px;
  border-radius: 6px;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  transition: all var(--transition-fast);
}
.btn--primary {
  background: var(--color-primary-300);
  color: var(--bg-app);
}
.btn--primary:hover {
  background: var(--color-primary-100);
}
.btn--secondary {
  background: var(--bg-card);
  border: 1px solid var(--border-default);
  color: var(--text-body);
}
.btn--secondary:hover {
  border-color: var(--color-primary-300);
  color: var(--text-heading);
}
```

### 7.9 Badges & Tags

```css
.badge {
  display: inline-flex;
  align-items: center;
  padding: 2px 8px;
  border-radius: 4px;
  font-size: 11px;
  font-weight: 500;
}
.badge--positive {
  background: var(--color-positive-bg);
  color: var(--color-primary-300);
}
.badge--negative {
  background: var(--color-negative-bg);
  color: var(--color-negative);
}
```

### 7.10 Dropdowns & Selects

```css
.select {
  background: var(--bg-input);
  border: 1px solid var(--border-default);
  color: var(--text-body);
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 13px;
  outline: none;
}
.select:focus {
  border-color: var(--color-primary-300);
}
```

### 7.11 Search Bar

```css
.search-container {
  position: relative;
  display: flex;
  align-items: center;
}
.search-input {
  background: var(--bg-input);
  border: 1px solid var(--border-default);
  color: var(--text-body);
  padding: 8px 12px 8px 36px;
  border-radius: 8px;
  font-size: 13px;
  outline: none;
  width: 240px;
}
.search-input:focus {
  border-color: var(--color-primary-300);
}
```

### 7.12 Progress Bars

```css
.progress {
  height: 6px;
  border-radius: 99px;
  background: var(--border-default);
  overflow: hidden;
  width: 100%;
}
.progress__bar {
  height: 100%;
  border-radius: 99px;
  background: var(--color-primary-300);
}
```

### 7.13 Checkboxes

```css
.checkbox {
  width: 16px;
  height: 16px;
  border-radius: 4px;
  border: 1.5px solid var(--border-default);
  background: var(--bg-card);
  appearance: none;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}
.checkbox:checked {
  background: var(--color-primary-300);
  border-color: var(--color-primary-300);
}
```

### 7.14 Avatar

```css
.avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  border: 1px solid var(--border-accent);
}
```

### 7.15 Tooltips

```css
.tooltip {
  position: absolute;
  background: var(--bg-sidebar);
  border: 1px solid var(--border-default);
  color: var(--text-body);
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
  pointer-events: none;
}
```

---

## 8. Dark Mode

Ares operates as a **strictly dark-first interface**. However, if you implement a high-contrast mode, map the selectors as followed:

### Dark Mode Component Adjustments

| Component | Default (Dark) | Alternative (Light Highlight) |
| :--- | :--- | :--- |
| **Canvas** | `#0a0a0a` | `#f4f5f7` |
| **Sidebar** | `#0d0d0d` | `#ffffff` |
| **Card** | `#121212` | `#ffffff` |
| **Border** | `#1f1f1f` | `#e8eaed` |
| **Accent Text** | `#84cc16` (Lime) | `#3f6212` (Dark Lime) |

---

## 9. Motion & Interaction States

### Transition Defaults
All interactable tags use fast-ease presets:

```css
.transition-all-fast {
  transition: all var(--transition-fast);
}
```

### State Table

| Selector | Default | Hover | Active / Clicked | Focus |
| :--- | :--- | :--- | :--- | :--- |
| **Sidebar Menu Item** | transparent | `rgba(132, 204, 22, 0.04)` | `--bg-active` | focus outline |
| **Primary Button** | `--color-primary-300` | `--color-primary-100` | darker tint | focus ring |
| **Checkbox** | `--bg-card` | border-color shifts | checked lime | focus ring |
| **Table Rows** | transparent | `--bg-card-hover` | — | — |

### Chart Animations (recommended)
* **Scale-In:** Bar chart columns scale from `scaleY(0)` to `scaleY(1)` over `400ms` on load.
* **Transition Ease:** `cubic-bezier(0.16, 1, 0.3, 1)`.

---

## 10. Accessibility

* **Contrast Ratios:** All white text (#ffffff) and light-gray text (#d1d5db) on `#0a0a0a`/`#121212` exceeds the WCAG AA requirement (4.5:1).
* **Keyboard Navigation:** Interacts with keyboard focus indicators (`outline`).
* **Screen Reader Semantics:** Navigation links leverage standard semantic tags (`<nav>`, `<aside>`, `<main>`).

---

## 11. Responsive Behaviour

Layout grids handle column changes dynamically using media query breakpoints:

```css
/* Medium Displays (Tablet) */
@media (max-width: 1024px) {
  .sidebar { width: 60px; } /* Sidebar wraps to icons-only rail */
  .stat-card-widget { grid-column: span 6; }
}

/* Small Displays (Mobile) */
@media (max-width: 768px) {
  .sidebar { display: none; } /* Sidebar hidden behind drawer */
  .stat-card-widget { grid-column: span 12; }
}
```
