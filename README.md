# Luhn Algorithm in PHP
This is an implementation of the Luhn Algorithm in PHP.

## Usage
Use the class like this:

	$luhn = new LuhnAlgorithm('1234 567-89');
	$luhn->isCompletelyValid();

Note that you the number may be a string that does contain non-numeric characters,
these will be stripped away.
The class contains some static functions as well. This will return the Luhn
checksum of a number:

	$number = '1234 567-89';
	$luhnCheckSum = LuhnAlgorithm::calculateChecksum($number);


## License
Copyright 2013 Niklas Ekman, nikl.ekman@gmail.com

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.