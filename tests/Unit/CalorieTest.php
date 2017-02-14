<?php



namespace Tests\Unit;

/**
 * Description of CalorieTest
 *
 * @author shivay
 */
use Tests\TestCase;
use \App\Http\Utils\SeedUtils;

class CalorieTest extends TestCase {

    public function testDaySummary() {
        echo "--------------Calorie::DaySummary------------------\n";
        SeedUtils::run();
        $email = "u" . uniqid() . "@email.com";
        $password = \App\Http\Utils\MsRand::generateRandomString();
        $response = $this->json('POST', '/register', ['name' => 'Test Name', 'email' => $email, 'password' => $password]);
        $response = $this->json('POST', '/authenticate', [ 'email' => $email, 'password' => $password]);
        $original = $response->original;
        $token = $original['token'];
        $response = $this->json('GET', 'calorie/daySummary', [], ['Authorization' => 'Bearer ' . $token]);
        $response->assertStatus(200)->assertJson([
            'sum' => 0,
            'calperday' => 0
        ]);
    }

    public function testIndex() {
        echo "--------------Calorie::Index------------------\n";
        SeedUtils::run();
        $email = "u" . uniqid() . "@email.com";
        $password = \App\Http\Utils\MsRand::generateRandomString();
        $response = $this->json('POST', '/register', ['name' => 'Test Name', 'email' => $email, 'password' => $password]);
        $response = $this->json('POST', '/authenticate', [ 'email' => $email, 'password' => $password]);
        $original = $response->original;
        $token = $original['token'];
        $response = $this->json('GET', 'calorie', [], ['Authorization' => 'Bearer ' . $token]);
        $response->assertStatus(200);
    }

    public function testStore() {
        echo "--------------Calorie::Store------------------\n";
        SeedUtils::run();
        $email = "u" . uniqid() . "@email.com";
        $password = \App\Http\Utils\MsRand::generateRandomString();
        $response = $this->json('POST', '/register', ['name' => 'Test Name', 'email' => $email, 'password' => $password]);
        $response = $this->json('POST', '/authenticate', [ 'email' => $email, 'password' => $password]);
        $original = $response->original;
        $token = $original['token'];
        $data = ['txt' => 'Demo Text',
            'numcalories' => 1234,
            'dt' => date("m-d-Y"),
            'tm' => date("H:i")];
        $response = $this->json('POST', 'calorie', $data, ['Authorization' => 'Bearer ' . $token]);
        $response->assertStatus(200);
    }

    public function testUpdate() {
        echo "--------------Calorie::Update------------------\n";
        SeedUtils::run();
        $email = "u" . uniqid() . "@email.com";
        $password = \App\Http\Utils\MsRand::generateRandomString();
        $response = $this->json('POST', '/register', ['name' => 'Test Name', 'email' => $email, 'password' => $password]);
        $response = $this->json('POST', '/authenticate', [ 'email' => $email, 'password' => $password]);
        $original = $response->original;
        $token = $original['token'];
        $data = ['txt' => 'Demo Text',
            'numcalories' => 1234,
            'dt' => date("m-d-Y"),
            'tm' => date("H:i")];
        $response = $this->json('POST', 'calorie', $data, ['Authorization' => 'Bearer ' . $token]);
        $original = $response->original;
        $model = $original['model'];
        $data['numcalories'] = 1111;
        $response = $this->json('PUT', 'calorie/' . $model->id, $data, ['Authorization' => 'Bearer ' . $token]);
        $response->assertStatus(200);
    }
      public function testDelete() {
        echo "--------------Calorie::Delete------------------\n";
        SeedUtils::run();
        $email = "u" . uniqid() . "@email.com";
        $password = \App\Http\Utils\MsRand::generateRandomString();
        $response = $this->json('POST', '/register', ['name' => 'Test Name', 'email' => $email, 'password' => $password]);
        $response = $this->json('POST', '/authenticate', [ 'email' => $email, 'password' => $password]);
        $original = $response->original;
        $token = $original['token'];
        $data = ['txt' => 'Demo Text',
            'numcalories' => 1234,
            'dt' => date("m-d-Y"),
            'tm' => date("H:i")];
        $response = $this->json('POST', 'calorie', $data, ['Authorization' => 'Bearer ' . $token]);
        $original = $response->original;
        $model = $original['model'];
        
        $response = $this->json('DELETE', 'calorie/' . $model->id, [], ['Authorization' => 'Bearer ' . $token]);
        $response->assertStatus(200);
    }

}
