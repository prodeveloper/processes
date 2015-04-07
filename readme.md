##Processes dispatcher

This package is an extension of the *chencha/conveyor* package found here (https://github.com/prodeveloper/conveyor)
This system parses a json file describing a process, compiles it to a *chencha/conveyor* process and runs it.

A sample process description would be:

	{
	  "name": "Registration",
	  "belts": [
	    {
	      "validation": ["EmailValidation"],
	      "persistence": [SaveInDatabase","UpdateElastic"]
	    }
	  ]
	}

This would be translated to the following steps

1. Start Registration Process
2. Run the given data through the validation belt
  * Run the subject through *EmailValidation* class
3. If no StopBeltException is thrown then run subject through persistence belt
  * Run the subject through *SaveInDatabase* class
  * Run the subject through *UpdateElastic* class
