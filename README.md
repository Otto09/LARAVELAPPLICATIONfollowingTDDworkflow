### `LARAVELAPPLICATIONfollowingTDDworkflow`
LARAVEL APPLICATION following a TDD workflow and VUE components.

If I had an endpoint to add a new owner using Withfaker TRAIT, a PHPUNIT FEATURE TEST assert that it should be inserted into the database and assert that I should be able to see it when I visit the page. After I submit the post request, the test assert that I will be redirected to that endpoint.

A new PHPUNIT FEATURE TEST assert that if I make a post request to that endpoint, but I don't give it an owner, the session has errors. The same for an animal.

I created a model factory for the Owner model which use a fake sentece for the owner and the same for the animal. The PHPUNIT FEATURE TEST use the model factory.
