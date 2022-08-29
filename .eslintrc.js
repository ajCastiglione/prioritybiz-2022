module.exports = {
	extends: 'plugin:@wordpress/eslint-plugin/recommended',
	root: true,
	env: {
		browser: true,
		commonjs: true,
		es6: true,
		jquery: true,
	},
	rules: {
		'max-len': [
			'error',
			{
				code: 115,
				ignoreUrls: true,
				ignoreTrailingComments: true,
				ignoreStrings: true,
				ignoreTemplateLiterals: true,
			},
		],
	},
	overrides: [],
};
