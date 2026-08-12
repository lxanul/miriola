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
            }
        }
    }
}
