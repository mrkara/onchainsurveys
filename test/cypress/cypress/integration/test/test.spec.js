/// <reference types="cypress" />

// Welcome to Cypress!
//
// This spec file contains a variety of sample tests
// for a todo list app that are designed to demonstrate
// the power of writing tests in Cypress.
//
// To learn more about how Cypress works and
// what makes it such an awesome testing tool,
// please read our getting started guide:
// https://on.cypress.io/introduction-to-cypress

require('cypress-plugin-tab');


describe('Onchain Surveys Test', () => {
  beforeEach(() => {
    // Cypress starts out with a blank slate for each test
    // so we must tell it to visit our website with the `cy.visit()` command.
    // Since we want to visit the same URL at the start of all our tests,
    // we include it in our beforeEach function so that it runs before each test
    cy.visit('https://onchainsurveys.semsofts.com') 
  })

  it('Create User', () => {

    var name    = "Bobby"
    var surname = "Fischer"
    var user_name = "fischer3"
    var email   = "fischer3unittest@gmail.com"
    var password   = "12345678"
    var confirm_password   = "12345678"

    // cy.wait(1*1000);

    // cy.get(':nth-child(5) > .nav-link').click();
    // cy.url().should('include','/user/login');

    // cy.get('#sign_up').click();
    // cy.url().should('include','/user/register');

    // cy.wait(1*1000);

    // cy.get('#name').type(name).should("have.value",name);
    // cy.get('#surname').type(surname).should("have.value",surname);
    // cy.get('#user_name').type(user_name).should("have.value",user_name);
    // cy.get('#email').type(email).should("have.value",email);
    // cy.get('#password').type(password).should("have.value",password);
    // cy.get('#confirm_password').type(confirm_password).should("have.value",confirm_password);
    // cy.get('#register_btn').click();

    // cy.url().should('include','/user/login');
    // cy.wait(1*1000);

  })


    it('Login User', () => {

      var user_name = "fischer";
      var password   = "12345678";

      var randomNumber = Math.floor(Math.random() * 101);
      var SurveyTitle = 'Demo Survey Title ' +randomNumber;
      var start_date = '2022-05-08T12:30';
      var end_date = '2022-06-08T23:59';
          
      cy.get(':nth-child(5) > .nav-link').click();
      cy.url().should('include','/user/login');

      cy.get('#user_name').type(user_name).should("have.value",user_name);
      cy.get('#password').type(password).should("have.value",password);
      cy.get('#login_btn').click();
      cy.wait(1*2000);

      cy.get('#create_btn').click();  
      cy.url().should('include','/survey/create');
      
        
      // create survey
      cy.get('#survey_title').type(SurveyTitle).should("have.value",SurveyTitle);
      cy.get('#start_date').type(start_date).should("have.value",start_date);
      cy.get('#end_date').type(end_date).should("have.value",end_date);

      // add question 
      cy.get('#text').type('Question 1 Demo '+ randomNumber);

      // options 
      cy.get(':nth-child(4) > .input-group > .form-control').type('Option 1 - '+ randomNumber);
      cy.get(':nth-child(5) > .input-group > .form-control').type('Option 2 - '+ randomNumber);
      
      // add option
      cy.get('.float-end > .btn').click();
      cy.get('.float-end > .btn').click();
      cy.get(':nth-child(6) > .input-group > .form-control').type('Option 3 - '+ randomNumber);
      cy.get(':nth-child(7) > .input-group > .form-control').type('Option 4 - '+ randomNumber);

       
      // add question
      cy.get('#addQuestion').click();
      // add option
      cy.get(':nth-child(6) > .float-end > .btn').click();

      cy.get('#text_1').type('Question 2 Demo '+ randomNumber);

      // options
      cy.tab().type('Option x -'+ randomNumber);
      cy.tab().type('Option y -'+ randomNumber);
      cy.tab().type('Option z -'+ randomNumber);

      


       
      // finish Survey
      cy.get('#finishSurvey').click();
      cy.wait(1*5000);

      cy.url().should('include','/survey/my_surveys');
     

    })


    // it('User Logout', () => {
    //       cy.wait(1*2000);
    //      cy.get('#logout').click();
         

    // })

    it('Super Admin Login', () => {
         cy.wait(1*1000);
         cy.get('#login').click();

          var user_name = "mehmet";
          var password   = "11111111";
          cy.get('#user_name').type(user_name).should("have.value",user_name);
          cy.get('#password').type(password).should("have.value",password);
          cy.get('#login_btn').click();
          cy.wait(1*1000);
 
          cy.get("#admin").realHover();
          cy.wait(1*1000);
          cy.get('#approve').click();
          cy.wait(1*1000);

          // edit survey
          cy.get('.editBtn:first').click();
          // cy.scrollTo(0, 1500);
          cy.scrollTo('bottom');

          cy.get('select').select('1');
          //is_approved
          // approved
          cy.get('#surveyApprove').click();
          cy.wait(1*1000);

          // go back
          cy.get('.text-left > a > .btn').click();
          cy.wait(1*1000);

          cy.get('#logout').click();
          

    })

  it('Login User And Survey Participate', () => {
      
      var user_name = "fischer";
      var password   = "12345678";

      // go to login page
      cy.get(':nth-child(5) > .nav-link').click();
      cy.url().should('include','/user/login');

      cy.get('#user_name').type(user_name).should("have.value",user_name);
      cy.get('#password').type(password).should("have.value",password);
      cy.get('#login_btn').click();
      cy.wait(1*1000);

      cy.get("#survey").realHover();
      cy.wait(1*1000);
      cy.get('#open_survey').click();
      cy.wait(1*1000);

      // go to bottom
      cy.scrollTo(0, 500);
      cy.wait(1*1000);
      cy.get('.text-center > div > .btn:first').click();
      cy.scrollTo(0, 1000);
      cy.wait(1*1000);

      // option select
      cy.get(':nth-child(1) > :nth-child(3) > :nth-child(1) > .form-check-label').click();
      // .form-check-label:first
      cy.wait(1*1000);
      cy.get(':nth-child(2) > :nth-child(3) > :nth-child(2) > .form-check-label').click();
      cy.wait(1*1000);
      cy.get('#finishSurvey').click();
      cy.wait(1*1000);

          
    })

   

})
