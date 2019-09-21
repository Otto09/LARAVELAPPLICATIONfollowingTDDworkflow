class AnimalboardForm {

	constructor(data) {

		this.originalData = {};

		// Object.assign(this.originalData, data);

		this.originalData = JSON.parse(JSON.stringify(data));

		// form.owner

		// form.animal

		Object.assign(this, data);

		this.errors = {};

		this.submitted = false;

	}

	data() {

		return Object.keys(this.originalData).reduce((data, attribute) => {

			data[attribute] = this[attribute];

			return data;

		}, {});

		/*let data = {};

		for (let attribute in this.originalData) {
			
			data[attribute] = this[attribute];

		}*/		

	}

	post(endpoint) {

		this.submit(endpoint);

	}

	patch(endpoint) {

		this.submit(endpoint, 'patch');

	}

	delete(endpoint) {

		this.submit(endpoint, 'delete');

	}

	submit(endpoint, requestType = 'post') {

		return axios[requestType](endpoint, this.data())

			.catch(this.onFail.bind(this))

			.then(this.onSuccess.bind(this));

	}

	onSuccess(response) {

		this.submitted = true;

		this.errors = {};

		return response;

	}

	onFail(error) {

		this.errors = error.response.data.errors;

		this.submitted = false;

		throw error;

	}

	reset() {

		Object.assign(this, this.originalData);

	}

}

export default AnimalboardForm;