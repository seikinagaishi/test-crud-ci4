<?php

namespace App\Controllers;

class User extends BaseController
{
	public function index() {
		$session = session();

		$data['title'] = 'Home';

		if($session->has('id')) {
			$this->idUsuario = $session->get('id');
			
			$usuarioModel = new \App\Models\UsuarioModel();
			$data['usuario'] = $usuarioModel->find($this->idUsuario);
			echo view('pages/home', $data);
		} else {
			return redirect()->to('public/login');
		}
	}

	public function login() {
		$data['title'] = 'Login';
		echo View('pages/login', $data);
	}

	public function register() {
		$data['title'] = 'Registro';
		echo View('pages/register', $data);
	}

	public function list() {
		$session = session();

		if($session->has('id')) {	
			$usuarioModel = new \App\Models\UsuarioModel();
			$data['usuario'] = $usuarioModel->find();
			$data['title'] = 'Lista';

			echo View('pages/list', $data);

		} else {
			redirect()->to('public/login');
		}
	}

	public function validateUser() {
		$formData = $this->request->getJSON();

		$usuarioModel = new \App\Models\UsuarioModel();
		$usuario = $usuarioModel->where('usuario', $formData->usuario)->where('senha', md5($formData->senha))->find();
		if($usuario) {
			$session = session();

			$sessionData = [
				'id' => $usuario[0]->id,
				'usuario' => $usuario[0]->usuario
			];
			
			$session->set($sessionData);

			$data['msg'] = 'Success';
		} else {
			$data['msg'] = 'Failed';
		}

		echo json_encode($data);
		exit;
	}

	public function logout() {
		$session = session();

		if($session->has('id')) {
			$session->destroy();
		}
	}

	public function registerUser() {
		$formData = $this->request->getJSON();

		$usuarioModel = new \App\Models\UsuarioModel();
		$usuarioModel->set('usuario', $formData->usuario);
		$usuarioModel->set('senha', md5($formData->senha));

		if($usuarioModel->insert()) {
			$data['msg'] = 'Success';
		} else {
			$data['msg'] = 'Failed';
		}

		echo json_encode($data);
		exit;
	}

	public function updateUser() {
		$session = session();
		$data['msg'] = 'Failed';

		if($session->has('id')) {
			$this->idUsuario = $session->get('id');
			$formData = $this->request->getJSON();
			
			$usuarioModel = new \App\Models\UsuarioModel();
			$usuario = $usuarioModel->find($this->idUsuario);
			$usuario->usuario = $formData->usuario;

			if($usuario->senha != $formData->senha) {
				$usuario->senha = md5($formData->senha);
			}

			if($usuarioModel->update($this->idUsuario, $usuario)) {
				$data['msg'] = 'Success';
			} else {
				$data['msg'] = 'Failed';
			}
		}

		echo json_encode($data);
		exit;
	}

	public function deleteUser() {
		$session = session();
		$data['msg'] = 'Failed';

		if($session->has('id')) {
			$this->idUsuario = $session->get('id');
			
			
			$usuarioModel = new \App\Models\UsuarioModel();
			$usuario = $usuarioModel->find($this->idUsuario);

			if($usuarioModel->delete($this->idUsuario)) {
				$data['msg'] = 'Success';
				$session->destroy();
			} else {
				$data['msg'] = 'Failed';
			}
		}

		echo json_encode($data);
		exit;
	}
}
