// import external dependencies
import 'jquery';
import ContentNav from './../functions/content-nav';

export default {
	init() {
		this.nav = new ContentNav('.article', ['h2', 'h3']);
	},
};
