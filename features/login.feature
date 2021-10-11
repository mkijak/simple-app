Feature:
  In order to prove that user login works fine

  Scenario: Provides bearer token when given valid user credentials
    Given User with email "user@mail.com" exists
    And user with email "user@mail.com" authorizes with password "zxasqw12"
    When I send a "POST" request to "/login" with body:
        """
        {
          "username": "user@mail.com",
          "password": "zxasqw12"
        }
        """
    Then the response status code should be 201
    And the response should be in JSON
    And the JSON node "token" should not be null

  Scenario: Does not provide a token when given invalid user credentials
    Given User with email "user@mail.com" exists
    And user with email "user@mail.com" authorizes with password "zxasqw12"
    When I send a "POST" request to "/login" with body:
        """
        {
          "username": "user@mail.com",
          "password": "1234567890"
        }
        """
    Then the response status code should be 401
    And the response should be in JSON
