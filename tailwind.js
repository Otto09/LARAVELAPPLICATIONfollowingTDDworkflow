module.exports = {

  theme: {

    extend: {

    	backgroundColor: {

    		page: "var(--page-background-color)",

    		card: "var(--card-background-color)",

    		button: "var(--button-background-color)",

    		header: "var(--header-background-color)"

    	},

    	textColor: {

        default: "var(--text-default-color)",

        accent: "var(--text-accent-color)",

        'accent-light': "var(--text-accent-color)",

        muted: "var(--text-muted-color)",

        'muted-light': "var(--text-muted-light-color)",

        error: "var(--text-error-color)",

    	},

      borderColor: {

        accent: "var(--border-accent-color)",

        error: "var(--border-error-color)",

        'muted-light': "var(--border-muted-light-color)",

      }
    }
  },

  variants: {},

  plugins: []

}
