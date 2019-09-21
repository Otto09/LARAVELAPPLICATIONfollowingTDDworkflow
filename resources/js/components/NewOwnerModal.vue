<template>
	
	<modal name="new-owner" classes="p-10 bg-card rounded-lg" height="auto">

  		<h1 class="font-normal text-2xl mb-16 text-center">

  			Let's Start Something New

  		</h1>

  		<form @submit.prevent="submit">

	  		<div class="flex ">
	  			
	  			<div class="flex-1 mr-4">
	  				
	  				<div class="mb-4">
	  					
	  					<label for="owner" class="text-normal block mb-2">Owner

	  						</label>

	  					<input type="text" 

	  						id="owner" 

	  						class="border py-1 px-2 block w-full rounded" 

  							:class="form.errors.owner ? 'border-error' : 

  								'border-muted-light'"

							v-model="form.owner">

						<span class="text-xs italic text-error" 

							v-if="form.errors.owner" 

							v-text="form.errors.owner[0]"></span>

	  				</div>

	  				<div class="mb-4">
	  					
	  					<label for="animal" class="text-normal block mb-2">Animal

	  						</label>

	  					<input type="text" id="animal" 

	  						class=" border py-1 px-2 block w-full 

	  							rounded 'border-muted-light'"

							:class="form.errors.animal ? 'border-error' : 

  								'border-muted-light'"

							v-model="form.animal">

						<span class="text-xs italic text-error" 

							v-if="form.errors.animal" 

							v-text="form.errors.animal[0]"></span>

	  				</div>

	  			</div>

	  			<div class="flex-1 ml-4">

	  				<div class="mb-4">
	  					
	  					<label class="text-normal block mb-2">
	  					
	  						Need Some Specifics ?

	  					</label>

	  					<input type="text" 

	  						class=" border border-muted-light 

	  							mb-2 py-1 px-2 block w-full rounded" 

	  						placeholder="Specific 1" 
	  						
	  						v-for="specific in form.specifics"

	  						v-model="specific.body">

	  				</div>  				

	  				<button type="button" class="button is-link rounded-full px-3 

	  					text-default" @click="addSpecific">+

	  				</button>

					<span>Add New Specific Field</span>  				
	  				
	  			</div>

	  		</div>

	  		<footer class="flex justify-end">
	  			
				<button class="button is-outlined mr-4" 

					@click="$modal.hide('new-owner')" 

					type="button">Cancel</button>

				<button class="button">Create Owner</button>

	  		</footer>

		</form>

	</modal>

</template>

<script>

	import AnimalboardForm from './AnimalboardForm';
	
	export default {

		data() {

			return {

				form: new AnimalboardForm({

					owner: '',

					animal: '',

					specifics: [

						{ body: '' },

					]

				})

				// errors: {}

			};

		},

		methods: {

			addSpecific() {

				this.form.specifics.push({ body: '' });

			},

			async submit() {

				if (! this.form.specifics[0].body) {

					delete this.form.originalData.specifics;

				}

				this.form.submit('/owners')

					.then(response => location = response.data.message)

				/*try {

					location = (await axios.post('/owners', this.form)).data.message;

				} catch (error) {

					this.errors = error.response.data.errors;

				}*/

			}

		}

	}

</script>