/* @author: Prabuddha Chakraborty */

exports.command = function() {
var client = this;

client
  .moveToElement('#wp-admin-bar-my-account a.ab-item',1,1)
  .pause(1000)
  .click('#wp-admin-bar-my-account-groups a.ab-item')
  .waitForElementVisible('body', 2500)
  .pause(800)
  .getTitle(function(title) {
      console.log("We are in Groups Page :"+title);
    })

return this;
};
