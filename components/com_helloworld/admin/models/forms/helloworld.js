/**
 * Created with JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/14/13
 * Time: 3:47 PM
 * To change this template use File | Settings | File Templates.
 */
window.addEvent('domready', function () {
	document.formvalidator.setHandler('greeting', function (value) {
		regex = /^[^0-9]+$/;
		return regex.test(value);
	});
});