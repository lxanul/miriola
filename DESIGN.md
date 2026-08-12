---
name: Coastal Elegance
colors:
  surface: '#fbf9f8'
  surface-dim: '#dcd9d9'
  surface-bright: '#fbf9f8'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f6f3f2'
  surface-container: '#f0eded'
  surface-container-high: '#eae7e7'
  surface-container-highest: '#e4e2e1'
  on-surface: '#1b1c1c'
  on-surface-variant: '#43474f'
  inverse-surface: '#303030'
  inverse-on-surface: '#f3f0f0'
  outline: '#737780'
  outline-variant: '#c3c6d1'
  surface-tint: '#3a5f94'
  primary: '#001e40'
  on-primary: '#ffffff'
  primary-container: '#003366'
  on-primary-container: '#799dd6'
  inverse-primary: '#a7c8ff'
  secondary: '#725a39'
  on-secondary: '#ffffff'
  secondary-container: '#fbdbb0'
  on-secondary-container: '#765f3d'
  tertiary: '#1d1f1f'
  on-tertiary: '#ffffff'
  tertiary-container: '#323434'
  on-tertiary-container: '#9b9c9c'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d5e3ff'
  primary-fixed-dim: '#a7c8ff'
  on-primary-fixed: '#001b3c'
  on-primary-fixed-variant: '#1f477b'
  secondary-fixed: '#feddb3'
  secondary-fixed-dim: '#e1c299'
  on-secondary-fixed: '#281801'
  on-secondary-fixed-variant: '#584324'
  tertiary-fixed: '#e2e2e2'
  tertiary-fixed-dim: '#c6c6c7'
  on-tertiary-fixed: '#1a1c1c'
  on-tertiary-fixed-variant: '#454747'
  background: '#fbf9f8'
  on-background: '#1b1c1c'
  surface-variant: '#e4e2e1'
typography:
  display-lg:
    fontFamily: Noto Serif
    fontSize: 48px
    fontWeight: '700'
    lineHeight: '1.2'
    letterSpacing: -0.02em
  display-lg-mobile:
    fontFamily: Noto Serif
    fontSize: 32px
    fontWeight: '700'
    lineHeight: '1.2'
  headline-md:
    fontFamily: Noto Serif
    fontSize: 32px
    fontWeight: '600'
    lineHeight: '1.3'
  headline-sm:
    fontFamily: Noto Serif
    fontSize: 24px
    fontWeight: '600'
    lineHeight: '1.4'
  body-lg:
    fontFamily: Work Sans
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Work Sans
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.6'
  label-caps:
    fontFamily: Work Sans
    fontSize: 12px
    fontWeight: '600'
    lineHeight: '1.0'
    letterSpacing: 0.1em
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  base: 8px
  section-gap: 80px
  section-gap-mobile: 48px
  gutter: 24px
  container-max: 1200px
---

## Brand & Style
The design system is built for a premium coastal resort experience, balancing professional reliability with the warmth of a holiday getaway. The aesthetic is **Corporate Modern** with **Minimalist** influences, focusing on high-quality photography and structured information delivery. 

The UI should evoke a sense of calm, luxury, and meticulous organization. It utilizes a refined grid system and generous whitespace to ensure the user feels relaxed while navigating—mirroring the physical experience of the resort itself. Visual elements are crisp, avoiding heavy shadows or decorative clutter, favoring structural integrity and typographic hierarchy to communicate value.

## Colors
The palette is derived from the coastal landscape to create an immediate emotional connection to the destination.

*   **Primary (Deep Sea Blue):** Used for navigation, primary headings, and heavy structural elements. It conveys trust and authority.
*   **Secondary (Sandy Beige):** Used for subtle backgrounds, dividers, and decorative accents to soften the interface.
*   **Tertiary (Crisp White):** The core canvas color. Used for card backgrounds and section containers to maintain a clean, airy feel.
*   **Accent (Sunset Orange):** Reserved strictly for primary Calls to Action (CTAs) and critical interactive highlights.
*   **Neutral (Charcoal):** Used for body text to ensure maximum readability against white and beige backgrounds.

## Typography
This design system employs a classic serif/sans-serif pairing to establish a "high-end editorial" feel. 

**Noto Serif** is used for all headlines and display text to provide a traditional, authoritative, and elegant voice. It should be typeset with slightly tighter letter-spacing for large displays.

**Work Sans** serves as the functional workhorse for body copy and UI labels. Its neutral, professional character ensures that lengthy descriptions of rooms or amenities remain highly legible and grounded. Use `label-caps` for small eyebrows above headlines to provide categorization without adding visual bulk.

## Layout & Spacing
The layout follows a **Fixed Grid** philosophy for desktop to maintain a structured, WordPress-premium feel, centering content within a 1200px container.

*   **Desktop:** 12-column grid with 24px gutters. Sections are separated by large 80px vertical gaps to allow the imagery to "breathe."
*   **Tablet:** 8-column grid with 24px gutters. Vertical spacing reduces to 64px.
*   **Mobile:** 4-column grid with 16px margins. Content stacks vertically.
*   **Rhythm:** All internal component spacing (padding/margins) must be multiples of the 8px base unit to maintain visual harmony.

## Elevation & Depth
Depth is achieved through **Tonal Layers** and extremely subtle **Ambient Shadows**. 

The primary surface is White (#FFFFFF). Secondary content sections use Sandy Beige (#D2B48C) at 10% opacity to create distinct horizontal bands across the page. 

Cards and interactive elements should use a "Large/Soft" shadow profile: a 20px blur with only 4-6% opacity using the Primary Deep Sea Blue as the shadow tint. This creates a lift that feels more like natural light than a digital effect. Avoid heavy borders; instead, use a 1px stroke of the Secondary color at 30% opacity to define edges where necessary.

## Shapes
The shape language is **Soft** and restrained. A 0.25rem (4px) base radius is applied to buttons, input fields, and small UI components. 

> **Uwaga o zgodności z kodem (2026-08-12).** Kilka reguł poniżej opisuje stan
> zamierzony, nie wdrożony. Rozjazdy: (1) kolor `secondary` nie jest używany
> nigdzie w widokach; (2) zasada „accent wyłącznie dla CTA" nie jest
> przestrzegana; (3) karty używają `rounded-2xl`, nie `rounded-lg`; (4) profil
> cieni nie odpowiada opisowi; (5) nazewnictwo palety („Deep Sea Blue", „Sandy
> Beige") i opisy zakładają ośrodek nadmorski, podczas gdy obiekt leży
> w **dolinie Skawy**. Przed kolejną iteracją UI trzeba zdecydować: dociągnąć
> kod do dokumentu albo dokument do kodu.

Large image containers and "Room Cards" use the `rounded-lg` (8px) setting. This subtle rounding removes the "sharpness" of a purely corporate site, making the resort feel more welcoming and approachable while maintaining a crisp, professional structure.

## Components
### Buttons
*   **Primary:** Sunset Orange background with White text. Bold weight, 4px corner radius. Used for "Book Now."
*   **Secondary:** Deep Sea Blue outline (2px) with Primary text. Used for "View Details."
*   **Ghost:** Sandy Beige text with no background, used for secondary navigation.

### Cards
*   **Room/Amenity Cards:** Feature a top-aligned image with a 1:1 or 4:3 aspect ratio. Text content sits below on a white background with a subtle ambient shadow. Use a 1px Sandy Beige border.

### Input Fields
*   **Date/Guest Pickers:** High-contrast white backgrounds with Deep Sea Blue icons. Focus states should use a 2px Deep Sea Blue bottom border rather than a full box glow.

### Additional Components
*   **Availability Bar:** A horizontal, floating bar at the bottom of the viewport on scroll, featuring the primary CTA to ensure booking is always one click away.
*   **Image Gallery:** A masonry or clean grid layout with 8px gaps and "Soft" rounded corners.