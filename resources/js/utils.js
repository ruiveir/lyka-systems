exports.template = (queryString, parameters) => {
	let template = $(queryString).html();

	for (let key of Object.keys(parameters))
		template = template.replace(new RegExp('\\$\\{' + key + '\\}', 'g'), parameters[key]);

	return $(template);
};