tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                primary: "#001e40", // Deep Sea Blue
                secondary: "#725a39", // Sandy Beige
                tertiary: "#1d1f1f", // Charcoal
                accent: "#FF6B6B", // Sunset Orange/Coral
                background: "#fbf9f8", // Warm Coastal Sand
                surface: "#ffffff",
                "on-background": "#1b1c1c",
                "on-surface": "#1b1c1c",
                "on-surface-variant": "#43474f",
                "surface-dim": "#dcd9d9",
                "outline-variant": "#c3c6d1"
            },
            borderRadius: {
                DEFAULT: "0.25rem", // 4px (Soft)
                sm: "0.125rem",
                md: "0.375rem",
                lg: "0.5rem", // 8px (Large rounded for cards and pictures)
                xl: "0.75rem",
                full: "9999px"
            },
            spacing: {
                base: "8px",
                gutter: "24px",
                "section-gap": "80px",
                "section-gap-mobile": "48px",
                "container-max": "1200px"
            },
            fontFamily: {
                display: ["Noto Serif", "serif"],
                body: ["Work Sans", "sans-serif"]
            },
            // Restored from the original prototype. Without these, all 19 uses of
            // text-display-lg / text-headline-* / text-body-* across the views
            // rendered at browser default size. See REVIEW.md CR-5.
            fontSize: {
                "display-lg": ["48px", { lineHeight: "1.2", letterSpacing: "-0.02em", fontWeight: "700" }],
                "display-lg-mobile": ["32px", { lineHeight: "1.2", fontWeight: "700" }],
                "headline-lg": ["40px", { lineHeight: "1.25", fontWeight: "600" }],
                "headline-md": ["32px", { lineHeight: "1.3", fontWeight: "600" }],
                "headline-sm": ["24px", { lineHeight: "1.4", fontWeight: "600" }],
                "body-lg": ["18px", { lineHeight: "1.6", fontWeight: "400" }],
                "body-md": ["16px", { lineHeight: "1.6", fontWeight: "400" }],
                "label-caps": ["12px", { lineHeight: "1.0", letterSpacing: "0.1em", fontWeight: "600" }]
            }
        }
    }
}
