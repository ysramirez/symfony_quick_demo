<?php

namespace App\Controller;

use App\Entity\Empleado;
use App\Form\CuestionarioType;
use App\Form\EmpleadoType;
use App\Recursos\Cuestionario;
use App\Repository\EmpleadoRepository;
use App\Services\PasswordGenerator;
use App\Services\SaveToFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/empleado')]
class EmpleadoController extends AbstractController
{
    #[Route('/', name: 'app_empleado_index', methods: ['GET'])]
    public function index(EmpleadoRepository $empleadoRepository): Response
    {
        return $this->render('empleado/index.html.twig', [
            'empleados' => $empleadoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_empleado_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EmpleadoRepository $empleadoRepository): Response
    {
        $empleado = new Empleado();
        $form = $this->createForm(EmpleadoType::class, $empleado);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $empleadoRepository->save($empleado, true);

            return $this->redirectToRoute('app_empleado_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('empleado/new.html.twig', [
            'empleado' => $empleado,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_empleado_show', methods: ['GET'])]
    public function show(Empleado $empleado): Response
    {
        return $this->render('empleado/show.html.twig', [
            'empleado' => $empleado,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_empleado_edit', methods: ['GET', 'POST'])]
    public function edit(Empleado $empleado, Request $request, EmpleadoRepository $empleadoRepository): Response
    {
        $form = $this->createForm(EmpleadoType::class, $empleado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $empleadoRepository->save($empleado, true);

            return $this->redirectToRoute('app_empleado_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('empleado/edit.html.twig', [
            'empleado' => $empleado,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_empleado_delete', methods: ['POST'])]
    public function delete(Request $request, Empleado $empleado, EmpleadoRepository $empleadoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$empleado->getId(), $request->request->get('_token'))) {
            $empleadoRepository->remove($empleado, true);
        }

        return $this->redirectToRoute('app_empleado_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/password/{lenght}', name: 'app_empleado_password', methods: ['GET'])]
    public function getPassword(PasswordGenerator $passwordGenerator, int $lenght): Response
    {
        return new Response($passwordGenerator->generatePassword($lenght));
    }

    #[Route('/pregunta/cuestionario', name: 'app_empleado_cuestionario')]
    public function cuestionario(): Response
    {
        $formCuestionario = $this->createForm(CuestionarioType::class, new Cuestionario(), [
            'action' => $this->generateUrl('app_empleado_enviar_cuestionario'),
            'method' => 'POST',
        ]);

        return $this->renderForm('empleado/cuestionario.html.twig', [
            'form' => $formCuestionario,
        ]);
    }

    #[Route('/pregunta/enviar', name: 'app_empleado_enviar_cuestionario')]
    public function recibirCuestionario(Request $request, SaveToFile $saveToFile): Response
    {
        $form =  $this->createForm(CuestionarioType::class, $cuestionario = new Cuestionario());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $saveToFile->setString($cuestionario->getOficina()."\n".$cuestionario->getPregunta());
            $saveToFile->save();
            return new Response('Se guardó la pregunta en el archivo '.$saveToFile->getFileName());
        }
        return new Response('no valido');
    }
}
