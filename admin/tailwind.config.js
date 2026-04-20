/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./index.html",
        "./src/**/*.{js,ts,jsx,tsx}",
    ],
    theme: {
        extend: {
            colors: {
                primary: 'var(--primary)',
                'primary-dark': 'var(--primary-dark)',
                'primary-light': 'var(--primary-light)',
                secondary: 'var(--secondary)',
                'secondary-dark': 'var(--secondary-dark)',
                'secondary-light': 'var(--secondary-light)',
                accent: 'var(--accent)',
                'accent-hover': 'var(--accent-hover)',
                'bg-body': 'var(--bg-body)',
                'bg-light': 'var(--bg-light)',
                'text-main': 'var(--text-main)',
                'text-muted': 'var(--text-muted)',
                'text-dark': 'var(--text-dark)',
                'border-light': 'var(--border-light)'
            },
            fontFamily: {
                sans: ['"Familjen Grotesk"', 'system-ui', 'sans-serif'],
                btn: ['"Lato"', 'sans-serif']
            },
            boxShadow: {
                'soft': 'var(--shadow-soft)',
                'float': 'var(--shadow-float)',
            }
        },
    },
    plugins: [],
}
