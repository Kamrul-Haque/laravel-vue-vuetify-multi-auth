<template>
	<Front>

		<Head title="Login" />

		<v-card
			class="mx-auto col-12 col-sm-8 col-md-4 col-xl-3"
			color="secondary"
			dark
		>
			<v-card-title class="text-h5 justify-center">Login</v-card-title>
			<v-card-text class="my-4">
				<v-form @submit.prevent="submit">
					<v-text-field
						v-model="form.email"
						:error-messages="form.errors.email"
						dense
						label="Email"
						prepend-inner-icon="mdi-email"
						solo-inverted
					>
					</v-text-field>
					<v-text-field
						v-model="form.password"
						:append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
						:error-messages="form.errors.password"
						:type="show ? 'text' : 'password'"
						class="mt-4"
						dense
						label="Password"
						prepend-inner-icon="mdi-lock"
						solo-inverted
						@click:append="show = !show"
					>
					</v-text-field>
					<div class="d-md-flex align-center">
						<v-checkbox
							v-model:checked="form.remember"
							color="primary"
							label="Remember Me"
						>
						</v-checkbox>

						<v-spacer></v-spacer>

						<Link
							:href="route('password.request')"
							color="primary"
						>
						forgot your password?
						</Link>
					</div>
					<v-btn
						:disabled="form.processing"
						block
						class="mt-3"
						color="primary"
						type="submit"
					>
						SUBMIT
					</v-btn>
				</v-form>
			</v-card-text>
		</v-card>
	</Front>
</template>

<script>
	import Front from "@/Layouts/Front";
	import { Head, Link } from "@inertiajs/inertia-vue";

	export default {
		components: {
			Front,
			Link,
			Head,
		},
		data() {
			return {
				show: false,
				form: this.$inertia.form({
					email: "",
					password: "",
					remember: false,
				}),
			};
		},
		methods: {
			submit() {
				this.form.post(this.route("login"), {
					onFinish: () => this.form.reset("password"),
				});
			},
		},
	};
</script>
