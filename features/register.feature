Feature:
  In order to prove that user registration works fine

  Scenario: Registers new user with e-mail and password
    Given User with email "user@mail.com" does not exist
    When I send a "POST" request to "/api/register" with body:
        """
        {
          "email": "user@mail.com",
          "password": "123strongpass"
        }
        """
    Then the response status code should be 201
    And the response should be in JSON

  Scenario: Does not register user when e-mail is already used
    Given User with email "user@mail.com" exists
    When I send a "POST" request to "/api/register" with body:
        """
        {
          "email": "user@mail.com",
          "password": "123strongpass"
        }
        """
    Then the response status code should be 400
    And the response should be in JSON
    And the JSON node "error" should be equal to "E-mail address user@mail.com is already in use"


  Scenario: Does not register user with empty password
    Given User with email "user@mail.com" does not exist
    When I send a "POST" request to "/api/register" with body:
        """
        {
          "email": "user@mail.com",
          "password": ""
        }
        """
    Then the response status code should be 400
    And the response should be in JSON
    And the JSON node "error" should be equal to "Password cannot be empty"
