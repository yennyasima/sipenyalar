const {
    addIconSelectors,
    addDynamicIconSelectors,
} = require("@iconify/tailwind");

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                abril: ["Abril Fatface", "serif"],
                Anek: ["Anek Latin", "serif"],
                inter: ["Inter", "serif"],
            },
            animation: {
                fadeIn: "fadeIn 1s ease-out",
            },
            boxShadow: {
                "custom-thick":
                    "0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -2px rgba(0, 0, 0, 0.3)",
            },
            textColor: {
                gradient:
                    "linear-gradient(90deg,#28C76F 35%, #81FBB8 74%, #08FFF0 94%)",
            },
            keyframes: {
                "custom-ping": {
                    "0%": { transform: "scale(1)", opacity: "1" },
                    "40%": { transform: "scale(1.5)", opacity: "0.7" },
                },
            },
            animation: {
                "custom-ping":
                    "custom-ping 2.5s cubic-bezier(0.4, 0, 0.2, 1) infinite",
            },
            // Add border gradient configuration
            borderColor: {
                gradient:
                    "linear-gradient(90deg, #28C76F 35%, #81FBB8 74%, #08FFF0 94%)",
            },

            backgroundImage: {
                count1: " url('{{ asset('assets/images/count1.png') }}')",
                count2: "url('{{ asset('assets/images/count2.png') }}')",
                count3: "url('{{ asset('assets/images/count3.png') }}')",
            },
        },
    },
    plugins: [
        require("@tailwindcss/typography"),
        require("flowbite/plugin"),
        addIconSelectors(["mdi", "mdi-light"]),
        addDynamicIconSelectors(),
        function ({ addComponents, theme }) {
            addComponents({
                ".border-gradient": {
                    backgroundImage: theme("borderColor.gradient"),
                    backgroundClip: "border-box",
                    border: "2px solid transparent", // Transparent border
                    padding: "4px", // Adjust padding to show the border
                },
            });
        },
    ],
};
